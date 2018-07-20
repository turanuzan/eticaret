<?php

namespace App\Http\Controllers;

use App\Models\Urun;
use Illuminate\Http\Request;

class UrunController extends Controller
{
    public function index($slug_urunadi)
    {
        //$urun = Urun::where('slug',$slug_urunadi)->firstOrFail();
        $urun = Urun::whereSlug($slug_urunadi)->firstOrFail();

        // belongsToMany ozelligi ile urunler modelinden kategoriler geldi
        // aynı ürün aynı kategoride birden fazla varsa tekilleştirmek adına distinct yaptık
        $kategoriler = $urun->kategoriler()->distinct()->get();

        return view('urun',compact('urun','kategoriler'));
    }

    public function ara()
    {
        $aranan = request()->input('aranan');
        $urunler = Urun::where('urun_adi','like',"%$aranan%")
            ->orWhere('aciklama','like',"%$aranan%")
            ->get();
        request()->flash();
        return view('arama',compact('urunler'));
    }
}
