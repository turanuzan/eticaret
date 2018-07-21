<?php

namespace App\Http\Controllers;

use App\Models\Urun;
use Gloudemans\Shoppingcart\Facades\Cart; // dışarıdan composer ile eklenen kütüphane
use Illuminate\Http\Request;
use Validator;

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

    public function guncelle($rowId)
    {
        // ajax ile kullanılmaktadır.

        // burdaki $this->validate metodunu kullamaktansa bu şekilde kendimiz yaptık.
        // $this->validate hata alındığında mesajlar view dosyasına otomatik gonderilir.
        // Validator::make yaptığımızda aşağıda olduğu gibi hata olduğunda yakalar ve ajax a o şekilde bir mesaj dönebiliriz.
        $validator = Validator::make(request()->all(), [
            'adet' => 'required|numeric|between:0,5'
        ]);

        if($validator->fails()){
            session()->flash('mesaj_tur','danger');
            session()->flash('mesaj','Adet değeri 1 ile 5 arasında olmalıdır.');
            return response()->json(['success' => false]);
        }

        Cart::update($rowId,request('adet'));

        // ajax ile kullanıldığında html tarafında mesaj verebilmek için aşağıdaki yöntem kullanılabilir.
        session()->flash('mesaj_tur','success');
        session()->flash('mesaj','Adet bilgisi güncellendi');

        return response()->json(['success' => true]);
    }
}
