<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Kullanici extends Authenticatable
{
    use SoftDeletes;

    protected $table = 'kullanici';

    protected $fillable = ['adsoyad', 'email', 'sifre', 'aktivasyon_anahtari', 'aktif_mi', 'yonetici_mi'];

    // hidden ozelligi ile sorgularda bu alanlar cekilmez.
    protected $hidden = ['sifre', 'aktivasyon_anahtari'];

    const CREATED_AT = 'olusturma_tarihi';
    const UPDATED_AT = 'guncelleme_tarihi';
    const DELETED_AT = 'silinme_tarihi';

    // override ediliyor.
    public function getAuthPassword()
    {
        /*
         * Burada login islemi yaparken
         * auth()->attempt(['email' => request('email'), 'password' => request('sifre')],request()->has('benihatirla'))
         * password alanina bizim turkce olarak tanımladığımız şifre alanı eşit olacak die belirtiyoruz.
         * */
        return $this->sifre;
    }

    public function detay()
    {
        return $this->hasOne('App\Models\KullaniciDetay');
    }
}
