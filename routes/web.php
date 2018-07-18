<?php

// ornekler
/*

Route::get('/', function () {
    return view('anasayfa');
});

Route::get('/merhaba', function (){
    return "Merhaba";
});

Route::get('/urun/{urun_adi}/{id?}',function ($urun_adi,$id = 0){
    return "Toplam : $id $urun_adi";
})->name('urun_detay');

Route::get('/kampanya',function (){
    return redirect()->route('urun_detay',['urun_adi' => 'elma','id' => 5]);
});
*/

Route::get('/','AnasayfaController@index')->name('anasayfa');

Route::view('/kategori','kategori');
Route::view('/urun','urun');
Route::view('/sepet','sepet');