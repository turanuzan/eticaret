<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kategori extends Model
{
    // Modelimizin softDeletes ile çalışacağını söylüyoruz.
    // Satır veri tabanından silindiğinde aslında silinmeyip silinme_tarihi kolonu doldurulacaktır.
    use SoftDeletes;

    // Bunu belirtmezsek laravel tablolari ararken sonuna "s" eki koyarak arar.
    // Bunu belirttiğimizde tablonun adını özel olarak tanimliyoruz
    protected $table = 'kategori';

    // Bu alan : tabloya veri eklerken hangi alanların doldurulması gerektiğini söylüyoruz.
    //protected $fillable = ['kategori_adi','slug'];

    // Bu alan : tabloda degiştirelemez olan alanlari giriyoruz. Boş bırakılırsa bütün kolonlara etki edilebileceğini söylüyoruz.
    // id alanı belirtilerek id dışındaki bütün alanlara ekleme yapılabileceğini belirtiyoruz.
    protected $guarded = ['id'];

    // Bu özellik kapatılarak laravelin otomatik aradigi created_at ve updated_at kolonlarını kullanmadığımız belirtiyoruz.
    //public $timestamps = false;

    // veya created_at ve updated_at kolonlarının eşneliği olan kolonlarımız varsa bunları belirtiyoruz.
    const CREATED_AT = 'olusturma_tarihi';
    const UPDATED_AT = 'guncelleme_tarihi';
    // softDeletes() özelliğinin vermiş olduğu deleted_at kolonu yerine kullanilan türkçe kolonun ismini tanımlıyoruz.
    const DELETED_AT = 'silinme_tarihi';
}
