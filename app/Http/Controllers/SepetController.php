<?php

namespace App\Http\Controllers;

use App\Models\Sepet;
use App\Models\SepetUrun;
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
        $cartItem = Cart::add($urun->id,$urun->urun_adi,1,$urun->fiyati,['slug' => $urun->slug]); // son parametrede ekstra alan gonderebiliriz.

        if(auth()->check()){ // kullanıcı girişi olup olmadığını kontrol etmektedir. Kullanıcı girişi yapanlar için geçerli
            $aktif_sepet_id = session('aktif_sepet_id');
            if(!isset($aktif_sepet_id)){
                $aktif_sepet = Sepet::create([
                    'kullanici_id' => auth()->id()
                ]);
                $aktif_sepet_id = $aktif_sepet->id;
                session()->put('aktif_sepet_id',$aktif_sepet_id);
            }

            SepetUrun::updateOrCreate(
                ['sepet_id' => $aktif_sepet_id, 'urun_id' => $urun->id], // where şartı gibi varsa gunceller yoksa yeni ekler.
                ['adet' => $cartItem->qty, 'fiyati' => $urun->fiyati, 'durum' => 'Beklemede']
            );
        }

        // bu şekilde with ile mesaj gonderebiliriz.Diğer kullanımı şekli KullaniciController da var
        return redirect()->route('sepet')
            ->with('mesaj_tur','success')
            ->with('mesaj','Ürün sepete eklendi.');
    }

    public function kaldir($rowId)
    {
        if(auth()->check()){ // kullanıcı girişi olup olmadığını kontrol etmektedir. Kullanıcı girişi yapanlar için geçerli
            $aktif_sepet_id = session('aktif_sepet_id');
            $cartItem = Cart::get($rowId); // verilen id ye gore o satırdaki bütün verilere ulaşılabilir.
            // delete() burada softdelete yapacak yani tabloda silinme tarihi alanını doldurur ve sorgularda gelmeyecektir.
            SepetUrun::where('sepet_id',$aktif_sepet_id)->where('urun_id',$cartItem->id)->delete();
        }

        Cart::remove($rowId);
        return redirect()->route('sepet')
            ->with('mesaj_tur','success')
            ->with('mesaj','Ürün sepetten kaldırıldı.');
    }

    public function bosalt()
    {
        if(auth()->check()){ // kullanıcı girişi olup olmadığını kontrol etmektedir. Kullanıcı girişi yapanlar için geçerli
            $aktif_sepet_id = session('aktif_sepet_id');
            SepetUrun::where('sepet_id',$aktif_sepet_id)->delete();
        }

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

        if(auth()->check()){
            $aktif_sepet_id = session('aktif_sepet_id');
            $cartItem = Cart::get($rowId);

            if(request('adet') > 0){
                SepetUrun::where('sepet_id',$aktif_sepet_id)
                    ->where('urun_id',$cartItem->id)
                    ->update(['adet' => request('adet')]);
            }else{ // adet 0 gelirse Cart kütüphanesi kendisinden kaldırıyor bizimde db den kaldırmamız gerekiyor.
                SepetUrun::where('sepet_id',$aktif_sepet_id)->where('urun_id',$cartItem->id)->delete();
            }
        }

        Cart::update($rowId,request('adet'));

        // ajax ile kullanıldığında html tarafında mesaj verebilmek için aşağıdaki yöntem kullanılabilir.
        session()->flash('mesaj_tur','success');
        session()->flash('mesaj','Adet bilgisi güncellendi');

        return response()->json(['success' => true]);
    }
}
