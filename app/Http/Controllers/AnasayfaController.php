<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
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
        return view('anasayfa',compact('kategoriler'));

    }
}
