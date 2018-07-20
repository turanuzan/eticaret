<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UrunDetay extends Model
{
    protected $table = 'urun_detay';
    protected $guarded = ['id'];
    public $timestamps = false; // created_at ve updated_at veya turkcede olsa kullanılmadığı için bu durumu false yapmamız gerekiyor.

    public function urun()
    {
        return $this->belongsTo('App\Models\Urun');
    }
}
