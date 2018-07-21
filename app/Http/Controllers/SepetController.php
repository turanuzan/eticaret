<?php

namespace App\Http\Controllers;

use App\Models\Urun;
use Gloudemans\Shoppingcart\Facades\Cart; // dışarıdan composer ile eklenen kütüphane
use Illuminate\Http\Request;

class SepetController extends Controller
{
    public function index()
    {
        return view('sepet');
    }

    public function ekle()
    {
        $urun = Urun::find(request('id'));
        Cart::add($urun->id,$urun->urun_adi,1,$urun->fiyati,['slug' => $urun->slug]); // son parametrede ekstra alan gonderebiliriz.

        // bu şekilde with ile mesaj gonderebiliriz.Diğer kullanımı şekli KullaniciController da var
        return redirect()->route('sepet')
            ->with('mesaj_tur','success')
            ->with('mesaj','Ürün sepete eklendi.');
    }

    public function kaldir($rowid)
    {
        Cart::remove($rowid);
        return redirect()->route('sepet')
            ->with('mesaj_tur','success')
            ->with('mesaj','Ürün sepetten kaldırıldı.');
    }

    public function bosalt()
    {
        Cart::destroy();
        return redirect()->route('sepet')
            ->with('mesaj_tur','success')
            ->with('mesaj','Sepetiniz boşaltıldı.');
    }
}
