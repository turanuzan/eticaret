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

// dogrudan view sayfasina gidilebilir.
Route::view('/kategori','kategori');
Route::view('/urun','urun');
Route::view('/sepet','sepet');

*/

Route::get('/','AnasayfaController@index')->name('anasayfa');

Route::get('/kategori/{slug_kategoriadi}','KategoriController@index')->name('kategori');
Route::get('/urun/{slug_urunadi}','UrunController@index')->name('urun');

Route::post('/ara','UrunController@ara')->name('urun_ara');
Route::get('/ara','UrunController@ara')->name('urun_ara');

Route::get('/sepet','SepetController@index')->name('sepet');
Route::get('/odeme','OdemeController@index')->name('odeme');
Route::get('/siparisler','SiparisController@index')->name('siparisler');
Route::get('/siparisler/{id}','SiparisController@detay')->name('siparis');

Route::group(['prefix' => 'kullanici'],function (){
    // her birinin onune kullanici yazmaktansa bu sekilde gruplamalar yapilabilir.
    //Route::get('/kullanici/oturumac','KullaniciController@giris_form')->name('kullanici.oturumac');
    Route::get('/oturumac','KullaniciController@giris_form')->name('kullanici.oturumac');
    Route::get('/kaydol','KullaniciController@kaydol_form')->name('kullanici.kaydol'); // adres satirindan acilirken
    Route::post('/kaydol','KullaniciController@kaydol'); // form gonderilirken, get icin isimlendirme yapıldığı için burada gerek yok
    Route::get('aktiflestir/{anahtar}','KullaniciController@aktiflestir')->name('aktiflestir');
});

// mail gondermeden gonderilecek mail şablonunu test edebiliriz.
Route::get('/test/mail',function(){
    $kullanici = \App\Models\Kullanici::find(1); // test amaçli direk ilk kullanıcıyı aldık.
    return new App\Mail\KullaniciKayitMail($kullanici);
});