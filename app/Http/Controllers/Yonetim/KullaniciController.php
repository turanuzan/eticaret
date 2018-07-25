<?php

namespace App\Http\Controllers\Yonetim;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class KullaniciController extends Controller
{
    public function oturumac()
    {
        if(request()->isMethod('POST')){

            $this->validate(request(),[
                'email' => 'required|email',
                'sifre' => 'required'
            ]);

            $credentials = [
                'email' => request('email'), // asagidaki gibi de request get ile de alınabilir.
                'password' => request()->get('sifre'),
                'yonetici_mi' => 1,
            ];

            // ÖNEMLİ --- ÇOKLU GİRİŞ ---
            /*
             * auth() kullanıldığında yönetici olarak giriş yapılırsa (auth()->attempt($credentials, request()->has('benihatirla')))
             * sanki müşteri olarakta giriş yapıldığını düşünüyor ve sadece müşterinin giriş yaptığında görebileceği sayfaları açıyor.
             * Bu şekilde olmaması için girişleri ayırmamız gerekiyor.
             * Müşteri ve Yönetici girişleri farklı olacak bunun için
             * auth() yerine Auth::guard('yonetim') dediğimizde sadece yönetim için giriş işlemi gerçekleşecektir.
             *
             * yani tam giriş kontrolü şöyle olacaktır. (Auth::guard('yonetim')->attempt($credentials, request()->has('benihatirla')))
             * ÖNEMLİ => guard için yazdığım yonetim girişini laravel e tanımlamamız gerekiyor.
             * tanımlamayı config içerisindeki auth.php içerisinde yapıyoruz.
             * guards array icerisinde yonetim olarak belirlediğimiz özellikleri tanımlamalıyız.
             *
             * tanımla yapıldıktan sonra config dosyalarının cache ini temizlemek gerek.
             * php artisan config:clear
             * php artisan config:cache
             *
             * */

            if(!Auth::guard('yonetim')->attempt($credentials, request()->has('benihatirla'))){ // giris başarısız ise
                // aşağıdaki iki yol kullanılabilir.
                return back()->withErrors(['email' => 'Hatalı giriş']);
                //return back()->withInput()->withErrors(['email' => 'Giriş hatalı']);
            }

            return redirect()->route('yonetim.anasayfa');
        }
        return view('yonetim.oturumac');
    }

    public function oturumukapat()
    {
        // auth()->logout(); demiyoruz. Çünkü giriş yaparken Auth::guard('yonetim') ile giriş yaptık artık bunu sıfırlamamız gerekiyor.
        Auth::guard('yonetim')->logout(); // yonetim ile ilgili yapılan giriş işlemini sıfırla diyoruz.
        request()->session()->flush();
        request()->session()->regenerate();
        return redirect()->route('yonetim.oturumac');
    }
}
