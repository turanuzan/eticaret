<?php

namespace App\Http\Controllers\Yonetim;

use App\Models\Siparis;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class AnasayfaController extends Controller
{
    public function index()
    {
        //$istatistikler = Cache::get('istatistikler');
        //if(!Cache::has('istatistikler')){} // bu şekilde de bir kontrol yapabilirdik ama o zaman else kısmında Cache::get('istatistikler'); demek durumunda kalırız.
        /*if(empty($istatistikler)){

            $istatistikler = [
                'bekleyen_siparis' => Siparis::where('durum','Siparişiniz alındı')->count()
            ];

            $bitisZamani = now()->addMinutes(10); // 10 dk lık zaman dilimi olarak ayarladık.

            Cache::put('istatistikler', $istatistikler, $bitisZamani); // her zaman eski veriyi siler yenisini ekler.
            //Cache::add('istatistikler', $istatistikler, $bitisZamani); // cache üzerinde var ise yeniyi eklemez
        }*/

        //Cache::forget('istatistikler'); // o keye ait cache siler
        //Cache::flush(); // tüm cache temizler

        // ******* yukarıdaki bütün kontrollerin yanında daha kullanışlı yol ise *******

        /*$bitisZamani = now()->addMinutes(10);

        $istatistikler = Cache::remember('istatistikler',$bitisZamani,function (){ // varsa getirir yoksa yenisini alır.
            return [
                'bekleyen_siparis' => Siparis::where('durum','Siparişiniz alındı')->count()
            ];
        });*/

        // *********************** TÜM VİEW DOSYALARINDA BU DEĞİŞKENE ULAŞMAK İSTİYORSAK
        // *********************** PROVIDER altında APPSERVICEPROVIDER dosyasında işlem yapıyoruz.

        //return view('yonetim.anasayfa',compact('istatistikler'));

        return view('yonetim.anasayfa');
    }
}
