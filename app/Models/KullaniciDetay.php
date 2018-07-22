<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KullaniciDetay extends Model
{
    protected $table = 'kullanici_detay';
    protected $guarded = ['id'];
    public $timestamps = false;

    public function kullanici()
    {
        return $this->belongsTo('App\Models\Kullanici');
    }
}
