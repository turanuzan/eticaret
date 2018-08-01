<?php

namespace App\Http\Controllers\Yonetim;

use App\Models\Kategori;
use App\Models\Urun;
use App\Models\UrunDetay;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UrunController extends Controller
{
    public function index()
    {
        if(request()->filled('aranan')){
            request()->flash();
            $aranan = request('aranan');
            $urunler = Urun::where('urun_adi','like',"%$aranan%")
                ->orWhere('aciklama','like',"%$aranan%")
                ->orderByDesc('id')
                ->paginate(8)
                ->appends('aranan',$aranan);
        }else{
            $urunler = Urun::orderByDesc('id')->paginate(8);
        }

        return view('yonetim.urun.index',compact('urunler'));
    }

    public function form($id = 0)
    {
        $urun = new Urun;
        $urun_kategoriler = [];
        if($id > 0){
            $urun = Urun::find($id);
            // pluck ile bir tablodan sadece istenilen kolon değeri getirilir.
            $urun_kategoriler = $urun->kategoriler()->pluck('kategori_id')->all();
        }

        $kategoriler = Kategori::all();

        return view('yonetim.urun.form',compact('urun','kategoriler','urun_kategoriler'));
    }

    public function kaydet($id = 0)
    {
        $data = request()->only('urun_adi','slug','aciklama','fiyati');

        if(!request()->filled('slug')){
            $data['slug'] = str_slug(request('urun_adi'));
            request()->merge(['slug' => $data['slug']]);
        }

        // db den gelen slug ile kullanıcının slug ı farklı ise db den kontrolleri yapalım.
        $this->validate(request(),[
            'urun_adi' => 'required',
            'fiyati' => 'required',
            'slug' => (request('orginal_slug') != request('slug')) ? 'unique:urun,slug' : '' // urun tablosundaki slug değerlerini kontrol eder ve aynı slug kayıt ettirmez
        ]);

        $data_detay = request()->only('goster_slider','goster_gunun_firsati','goster_one_cikan','goster_cok_satan','goster_indirimli');

        $kategoriler = request('kategoriler');

        if($id > 0){
            // guncelle
            $urun = Urun::where('id',$id)->firstOrFail();
            $urun->update($data);

            // Urun Detayını güncellemenin 1.yontemi.
            //$urun_detay = UrunDetay::where('urun_id',$id)->firstOrFail();
            //$urun_detay->goster_slider = request('goster_slider');
            //$urun_detay->save();

            // Urun Detayını güncellemenin 2.yontemi.
            $urun->detay()->update($data_detay); // update içine array gonderilmelidir.
            $urun->kategoriler()->sync($kategoriler); // sync : many to many tablolarında yeni değerlere göre senkron eder.


        }else{
            // kaydet
            $urun = Urun::create($data); // create içine array gonderilmelidir.
            $urun->detay()->create($data_detay);
            $urun->kategoriler()->attach($kategoriler); // attach : many to many tablolarına veri eklemeyi sağlar
        }

        return redirect()->route('yonetim.urun.duzenle',$urun->id)
            ->with('mesaj_tur','success')
            ->with('mesaj',($id > 0) ? 'Güncellendi' : 'Kaydedildi');
    }

    public function sil($id)
    {
        $urun = Urun::find($id);
        $urun->kategoriler()->detach();
        //$urun->detay()->delete(); // softDelete kullandığımız için detayının silinmeyebilir.
        $urun->delete();
        return redirect()->route('yonetim.urun')
            ->with('mesaj_tur','success')
            ->with('mesaj','Kayıt silindi');
    }
}
