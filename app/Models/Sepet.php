<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sepet extends Model
{
    use SoftDeletes;

    // laravel de Sepet Kütüphanesi bulunmakta. composer require gloudemans/shoppingcart kurulumu yapıldı
    // composer.json içerisinde ekleniyor.

    // php artisan vendor:publish --provider="Gloudemans\Shoppingcart\ShoppingcartServiceProvider" --tag="config"
    // bu komut ile vendor içerisindeki config ayarlarında cart.php kendimize göre değiştirmek istiyoruz.
    // vendor içerisinde yapmaktansa kendi config dosyamız içerisine yukarıdaki komut ile cart.php taşıyoruz.

    protected $table = 'sepet';
    protected $guarded = ['id'];

    const CREATED_AT = 'olusturma_tarihi';
    const UPDATED_AT = 'guncelleme_tarihi';
    const DELETED_AT = 'silinme_tarihi';
}
