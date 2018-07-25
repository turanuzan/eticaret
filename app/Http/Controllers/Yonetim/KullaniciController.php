<?php

namespace App\Http\Controllers\Yonetim;

use App\Models\Kullanici;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
                'aktif_mi' => 1
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

    public function index()
    {
        $list = Kullanici::orderByDesc('olusturma_tarihi')->paginate(8);
        return view('yonetim.kullanici.index',compact('list'));
    }

    // hem ekleme hem guncelleme icin bu fonksiyon kullanılacak
    // ekleme de id gonderilemeyeceği için id=0 olarak tanımlıyoruz
    public function form($id = 0)
    {
        $kullanici = new Kullanici; // bos bir kullanici bilgisi ile eşitliyoruz.
        if($id > 0){
            $kullanici = Kullanici::find($id);
        }

        return view('yonetim.kullanici.form',compact('kullanici'));
    }

    public function kaydet($id = 0)
    {
        $this->validate(request(),[
            'adsoyad' => 'required',
            'email' => 'required|email',
        ]);

        $data = request()->only('adsoyad','email'); // request icerisinde sadece bu alanları alalım.
        if(request()->filled('sifre')){ // eger sifre alani doldurulmus ise data içerisine dahil edelim
            $data['sifre'] = Hash::make(request('sifre'));
        }

        // alanin doldurulup doldurulmadıgı veya checkboxlarda secildi mi secilmedi mi
        $data['aktif_mi'] = request()->has('aktif_mi') ? 1 : 0;
        $data['yonetici_mi'] = request()->has('yonetici_mi') ? 1 : 0;

        if($id > 0){
            // guncelle
            $kullanici = Kullanici::where('id',$id)->firstOrFail();
            $kullanici->update($data);
        }else{
            // kaydet
            $kullanici = Kullanici::create($data);
        }

        return redirect()->route('yonetim.kullanici.duzenle',$kullanici->id)
            ->with('mesaj_tur','success')
            ->with('mesaj',($id > 0) ? 'Güncellendi' : 'Kaydedildi');
    }

}
