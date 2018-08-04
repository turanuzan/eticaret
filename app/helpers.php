<?php
/**
 * Created by PhpStorm.
 * User: esertopcu
 * Date: 4.08.2018
 * Time: 10:54
 */

use App\Models\Ayar;
use Illuminate\Support\Facades\Cache;

/***** !!!!!!!!!!!!!!!!! ÖNEMLİ !!!!!!!!!!!!!!!!  ******/
// helpers içerisindeki fonksiyonları direk olarak kullanabilmek için
// composer.json içerisindeki autoload içerisine
// files:[app/helpers.php] olarak ekliyoruz.
// son adım olarak daha önceden oluşturulmuş autoload ayarlarını sıfırlayıp tekrar oluşturmak için
// composer dump-autoload yapılarak eski autoload silinerek bu helpers.php ninde autoload dosyalarının içerisine alınmasını sağladık.

if(!function_exists('get_ayar')){
    function get_ayar($anahtar){
        //Cache::forget('tumAyarlar');
        $bitisZamani = now()->addMinutes(60);
        $tumAyarlar = Cache::remember('tumAyarlar',$bitisZamani,function (){ // varsa getirir yoksa yenisini alır.
            return Ayar::all();
        });

        return $tumAyarlar->where('anahtar',$anahtar)->first()->deger;
    }
}