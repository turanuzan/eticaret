<?php

namespace App\Http\Controllers\Yonetim;

use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KategoriController extends Controller
{
    public function index()
    {
        if(request()->filled('aranan') || request()->filled('ust_id')){
            request()->flash(); // istekte gelen input degerlerini session alir
            $aranan = request('aranan');
            $ust_id = request('ust_id');
            //with('ust_kategori') denildiğinde Kategori modelinde ust_kategori() fonksiyonu ile beraber çeker.
            // index.blade.php de $kategori->ust_kategori->kategori_adi yapmıştık. Burada her kategori için ayrı ayrı sorgu atacaktır. (Buraya with eklemeden once)
            // with('ust_kategori') ile çektiğimizde bütün kategoriler için sadece bir kere çalışacaktır.  ve html de $kategori->ust_kategori->kategori_adi yapmamız sıkıntı olmayacak.
            $kategoriler = Kategori::with('ust_kategori')
                ->where('kategori_adi','like',"%$aranan%")
                ->where('ust_id',$ust_id)
                ->orderByDesc('id')
                ->paginate(8)
                ->appends(['aranan' => $aranan, 'ust_id' => $ust_id]); // sayfalandirmalarda ana kategoriyi de ekledik
        }else{
            request()->flush(); // istekte gelen input degerleri session dan silinir.
            $kategoriler = Kategori::with('ust_kategori')->orderByDesc('id')->paginate(8);
        }

        // whereRaw ile bu tarzda kücük sql şartları yazabiliriz.
        $anakategoriler = Kategori::whereRaw('ust_id is null')->get();

        return view('yonetim.kategori.index',compact('kategoriler','anakategoriler'));
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
            'slug' => (request('orginal_slug') != request('slug')) ? 'unique:kategori,slug' : '' // kategori tablosundaki slug değerlerini kontrol eder ve aynı slug kayıt ettirmez
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
        // attach/detach
        // attach : many to many tablolarına veri eklemeyi sağlar
        // detach : many to many tablolarından ilişkili olan veriyi siler.
        // yani kategori tablosundan kategori silindiğinde kategori_urun tablosundan da siler.

        $kategori = Kategori::find($id);
        $kategori->urunler()->detach();
        //Kategori::destroy($id); bunun yerine aşağıdaki komut kullanılabilir.
        $kategori->delete();

        return redirect()->route('yonetim.kategori')
            ->with('mesaj_tur','success')
            ->with('mesaj','Kayıt silindi');
    }
}
