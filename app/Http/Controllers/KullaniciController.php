<?php

namespace App\Http\Controllers;

use App\Mail\KullaniciKayitMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\Kullanici;

class KullaniciController extends Controller
{
    public function __construct()
    {
        // Bu middleware kullanılabilmesi için RedirectIfAuthenticated.php içerisinde açıklamaları oku
        // bu tanımlama ile bu controller içerisinde var olan metodlara
        // kullanıcı girişi YAPMAMIŞ kişilerin erişmesine izin veriyoruz.
        $this->middleware('guest')->except('oturumukapat');
        //burada sonuna eklenen except içerisinde bu kurala oturumukapat metodunun dahil olmadığı belirtilmiştir.
        // çünkü oturumukapat kullanılması için giriş işleminin yapılması gerekmektedir.

        // VEYA

        // controller içerisinde bu şekilde middleware kullanılarak
        // bu controller a ulaşması için GİRİŞ YAPMASI zorlanmaktadır.
        //$this->middleware('auth');

    }

    public function giris_form()
    {
        return view('kullanici.oturumac');
    }

    public function giris()
    {
        $this->validate(request(),[
            'email' => 'required|email',
            'sifre' => 'required'
        ]);

        // login islemi basarısız olursa
        if(!auth()->attempt(['email' => request('email'), 'password' => request('sifre')],request()->has('benihatirla'))) {
            $errors = ['email' => 'Hatalı giriş'];
            return back()->withErrors($errors); // giris yaptığımız sayfaya tekrar yonlendirme yapar
        }

        request()->session()->regenerate();
        // ornek olarak -- odeme sayfasını açtık ama bizi giriş sayfasına yönlendirdi.
        // giriş işleminden sonra bizi ödeme sayfasına yönlendirir. Eğer ödeme sayfasını bulamaz ise anasayfaya yönlendirir.
        return redirect()->intended('');

    }

    public function kaydol_form()
    {
        return view('kullanici.kaydol');
    }

    public function kaydol()
    {
        $this->validate(request(),[
            'adsoyad' => 'required|min:5|max:60',
            'email' => 'required|email|unique:kullanici',
            'sifre' => 'required|confirmed|min:4|max:15',
        ]);

        $kullanici = Kullanici::create([
            'adsoyad' => request('adsoyad'),
            'email' => request('email'),
            'sifre' => Hash::make(request('sifre')),
            'aktivasyon_anahtari' => Str::random(60),
            'aktif_mi' => 0,
        ]);

        Mail::to($kullanici->email)->send(new KullaniciKayitMail($kullanici));

        auth()->login($kullanici); // kayıt olduktan sonra sisteme login olmasını sağlıyoruz

        return redirect()->route('anasayfa');
    }

    public function aktiflestir($anahtar)
    {
        $kullanici = Kullanici::where('aktivasyon_anahtari',$anahtar)->first();

        if(is_null($kullanici) || empty($kullanici)){
            return redirect()->to('/')
                ->with('mesaj','Kullanıcı kaydınız aktifleştirilemedi.')
                ->with('mesaj_tur','warning');
        }

        $kullanici->aktivasyon_anahtari = null;
        $kullanici->aktif_mi = 1;
        $kullanici->save();
        return redirect()->to('/')
            ->with('mesaj','Kullanıcı kaydınız aktifleştirildi.')
            ->with('mesaj_tur','success');
    }

    public function oturumukapat()
    {
        auth()->logout();
        request()->session()->flush();
        request()->session()->regenerate();
        return redirect()->route('anasayfa');
    }
}
