<?php

namespace App\Providers;

use App\Models\Ayar;
use App\Models\Kategori;
use App\Models\Kullanici;
use App\Models\Siparis;
use App\Models\Urun;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        // TÜM VİEW DOSYALARINDA KULLANMAK İÇİN
        /*

        $bitisZamani = now()->addMinutes(10);

        $istatistikler = Cache::remember('istatistikler',$bitisZamani,function (){ // varsa getirir yoksa yenisini alır.
            return [
                'bekleyen_siparis' => Siparis::where('durum','Siparişiniz alındı')->count()
            ];
        });

        View::share('istatistikler',$istatistikler); // tüm view dosyalarında kullanabiliriz.

        */

        // SADECE BELİRLİ VİEW DOSYALARINDA KULLANMAK İÇİN
        View::composer(['yonetim.*'],function ($view){
            $bitisZamani = now()->addMinutes(10);

            $istatistikler = Cache::remember('istatistikler',$bitisZamani,function (){ // varsa getirir yoksa yenisini alır.
                return [
                    'bekleyen_siparis' => Siparis::where('durum','Siparişiniz alındı')->count(),
                    'tamamlanan_siparis' => Siparis::where('durum','Sipariş tamamlandı')->count(),
                    'toplam_urun' => Urun::count(),
                    'toplam_kategori' => Kategori::count(),
                    'toplam_kullanici' => Kullanici::count()
                ];
            });

            $view->with('istatistikler',$istatistikler);
        });

        /*********** !!!!!!!!!!!!!!! ÖNEMLİ !!!!!!!!!!!!!!!!!!!! *************/
        //AppServiceProvider.php proje ilk çalıştığında burdaki ayarlar okunur.
        // Ayarlar tablosundaki değerler okunarak Config içerisine setlenir.
        // Kullanımını AnasayfaController.php içerisinde görebiliriz.
        // Helper Method ile db den çekip cache yazmaktansa bu özellik daha güzel gibi görünüyor.

        if(Schema::hasTable('ayar')){ // ayar tablosu mevcut ise
            foreach (Ayar::all() as $ayar) {
                Config::set('ayar.' . $ayar->anahtar, $ayar->deger);
            }
        }

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
