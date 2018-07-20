<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Urun;
use App\Models\UrunDetay;
use Illuminate\Http\Request;

class AnasayfaController extends Controller
{
    public function index()
    {
        //$isim = 'Sezer';
        //return view('anasayfa',['isim' => 'Eser']); // 1.yol
        //return view('anasayfa',compact('isim')); // 2.yol
        //return view('anasayfa')->with('isim','Eserr'); // 3.yol veya array icerisinde key-value gonderilebilir.

        $kategoriler = Kategori::whereRaw('ust_id is null')->take(8)->get(); // sadece 8 kayıt getirir.

        // urun_detay bilgilerini detay bilgisinin sahip oldugu urun ile birlikte cekmek icin
        //$urunler_slider = UrunDetay::with('urun')->where('goster_slider',1)->take(5)->get();
        $urunler_slider = Urun::select('urun.*')
            ->join('urun_detay','urun_detay.urun_id','urun.id')
            ->where('urun_detay.goster_slider',1)
            ->orderBy('guncelleme_tarihi','desc')
            ->take(5)->get();

        // iliskili tablolarda join kullanımı
        $urun_gunun_firsati = Urun::select('urun.*')
            ->join('urun_detay','urun_detay.urun_id','urun.id')
            ->where('urun_detay.goster_gunun_firsati',1)
            ->orderBy('guncelleme_tarihi','desc')
            ->first();

        //$urunler_one_cikan = UrunDetay::with('urun')->where('goster_one_cikan',1)->take(4)->get();
        $urunler_one_cikan = Urun::select('urun.*')
            ->join('urun_detay','urun_detay.urun_id','urun.id')
            ->where('urun_detay.goster_one_cikan',1)
            ->orderBy('guncelleme_tarihi','desc')
            ->take(4)->get();

        //$urunler_cok_satan = UrunDetay::with('urun')->where('goster_cok_satan',1)->take(4)->get();
        $urunler_cok_satan = Urun::select('urun.*')
            ->join('urun_detay','urun_detay.urun_id','urun.id')
            ->where('urun_detay.goster_cok_satan',1)
            ->orderBy('guncelleme_tarihi','desc')
            ->take(4)->get();

        //$urunler_indirimli = UrunDetay::with('urun')->where('goster_indirimli',1)->take(4)->get();
        $urunler_indirimli = Urun::select('urun.*')
            ->join('urun_detay','urun_detay.urun_id','urun.id')
            ->where('urun_detay.goster_indirimli',1)
            ->orderBy('guncelleme_tarihi','desc')
            ->take(4)->get();

        return view('anasayfa',compact('kategoriler','urunler_slider','urun_gunun_firsati','urunler_one_cikan','urunler_cok_satan','urunler_indirimli'));

    }
}
