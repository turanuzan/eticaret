<?php

namespace App\Http\Controllers\Yonetim;

use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KategoriController extends Controller
{
    public function index()
    {
        if(request()->filled('aranan')){
            request()->flash();
            $aranan = request('aranan');
            $kategoriler = Kategori::where('kategori_adi','like',"%$aranan%")
                ->orderByDesc('olusturma_tarihi')
                ->paginate(8)
                ->appends('aranan',$aranan);
        }else{
            $kategoriler = Kategori::orderByDesc('olusturma_tarihi')->paginate(8);
        }

        return view('yonetim.kategori.index',compact('kategoriler'));
    }

    public function form($id = 0)
    {
        $kategori = new Kategori();
        if($id > 0){
            $kategori = Kategori::find($id);
        }

        $kategoriler = Kategori::all();

        return view('yonetim.kategori.form',compact('kategori','kategoriler'));
    }

    public function kaydet($id = 0)
    {
        $data = request()->only('kategori_adi','slug','ust_id');

        if(!request()->filled('slug')){
            $data['slug'] = str_slug(request('kategori_adi'));
            request()->merge(['slug' => $data['slug']]); // request mergelenerek slug degeri request icerisine eklenmiş oldu.
        }

        // db den gelen slug ile kullanıcının slug ı farklı ise db den kontrolleri yapalım.
        $this->validate(request(),[
            'kategori_adi' => 'required',
            'slug' => (request('orjinal_slug') != request('slug')) ? 'unique:kategori,slug' : '' // kategori tablosundaki slug değerlerini kontrol eder ve aynı slug kayıt ettirmez
        ]);

        if($id > 0){
            // guncelle
            $kategori = Kategori::where('id',$id)->firstOrFail();
            $kategori->update($data);

        }else{
            // kaydet
            $kategori = Kategori::create($data);
        }

        return redirect()->route('yonetim.kategori.duzenle',$kategori->id)
            ->with('mesaj_tur','success')
            ->with('mesaj',($id > 0) ? 'Güncellendi' : 'Kaydedildi');
    }

    public function sil($id)
    {
        Kullanici::destroy($id);
        return redirect()->route('yonetim.kullanici')
            ->with('mesaj_tur','success')
            ->with('mesaj','Kayıt silindi');
    }
}
