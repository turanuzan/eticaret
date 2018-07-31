<?php

namespace App\Http\Controllers\Yonetim;

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
        if($id > 0){
            $urun = Urun::find($id);
        }

        return view('yonetim.urun.form',compact('urun'));
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

        if($id > 0){
            // guncelle
            $urun = Urun::where('id',$id)->firstOrFail();
            $urun->update($data);

        }else{
            // kaydet
            $urun = Urun::create($data);
        }

        return redirect()->route('yonetim.urun.duzenle',$urun->id)
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
