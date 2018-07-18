<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
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