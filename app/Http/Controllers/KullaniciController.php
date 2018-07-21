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
    public function giris_form()
    {
        return view('kullanici.oturumac');
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
}
