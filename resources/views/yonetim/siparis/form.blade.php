@extends('yonetim.layouts.master')
@section('title','Sipariş Yönetimi')
@section('content')
    <h1 class="page-header">Sipariş Yönetimi</h1>

    <form action="{{ route('yonetim.siparis.kaydet',@$siparis->id) }}" method="post">
        {{ csrf_field() }}
        <div class="pull-right">
            <button type="submit" class="btn btn-primary">{{ @$siparis->id > 0 ? "Güncelle" : "Kaydet" }}</button>
        </div>
        <h3 class="sub-header">Sipariş {{ @$siparis->id > 0 ? "Düzenle" : "Ekle" }}</h3>

        @include('layouts.partials.errors')
        @include('layouts.partials.alert')

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="adsoyad">Ad Soyad</label>
                    <input type="text" class="form-control" id="adsoyad" name="adsoyad" placeholder="Ad Soyad" value="{{ old('adsoyad',@$siparis->adsoyad) }}">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="telefon">Telefon</label>
                    <input type="text" class="form-control" id="telefon" name="telefon" placeholder="Telefon" value="{{ old('telefon',@$siparis->telefon) }}">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="ceptelefonu">Cep Telefonu</label>
                    <input type="text" class="form-control" id="ceptelefonu" name="ceptelefonu" placeholder="Cep Telefonu" value="{{ old('ceptelefonu',@$siparis->ceptelefonu) }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="adres">Adres</label>
                    <input type="text" class="form-control" id="adres" name="adres" placeholder="Adres" value="{{ old('adres',@$siparis->adres) }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="durum">Durum</label>
                    <select name="durum" id="durum" class="form-control">
                        <option {{ old('durum',@$siparis->durum) == 'Siparişiniz alındı' ? 'selected' : '' }} >Siparişiniz alındı</option>
                        <option {{ old('durum',@$siparis->durum) == 'Ödeme onaylandı' ? 'selected' : '' }} >Ödeme onaylandı</option>
                        <option {{ old('durum',@$siparis->durum) == 'Kargoya verildi' ? 'selected' : '' }} >Kargoya verildi</option>
                        <option {{ old('durum',@$siparis->durum) == 'Sipariş tamamlandı' ? 'selected' : '' }} >Sipariş tamamlandı</option>
                    </select>
                </div>
            </div>
        </div>
    </form>

    <h2>Sipariş (SP-{{ $siparis->id }})</h2>
    <table class="table table-bordererd table-hover">
        <tr>
            <th colspan="2">Ürün</th>
            <th>Tutar</th>
            <th>Adet</th>
            <th>Ara Toplam</th>
            <th>Durum</th>
        </tr>
        @foreach($siparis->sepet->sepet_urunler as $sepet_urun)
            <tr>
                <td style="width: 120px;">
                    <a href="{{ route('urun',$sepet_urun->urun->slug) }}">
                        <img src="{{ $sepet_urun->urun->detay->urun_resmi != null ? asset('uploads/urunler/'.$sepet_urun->urun->detay->urun_resmi) : 'http://via.placeholder.com/120x100?text=UrunResmi' }}" style="height: 120px;">
                    </a>
                </td>
                <td>
                    <a href="{{ route('urun',$sepet_urun->urun->slug) }}">{{ $sepet_urun->urun->urun_adi }}</a>
                </td>
                <td>{{ $sepet_urun->fiyati }}</td>
                <td>{{ $sepet_urun->adet }}</td>
                <td>{{ $sepet_urun->fiyati * $sepet_urun->adet }}</td>
                <td>{{ $sepet_urun->durum }}</td>
            </tr>
        @endforeach
        <tr>
            <th colspan="4" class="text-right">Toplam Tutar</th>
            <td colspan="2">{{ $siparis->siparis_tutari }}</td>
        </tr>
        <tr>
            <th colspan="4" class="text-right">Toplam Tutar (KDV'li)</th>
            <td colspan="2">{{ $siparis->siparis_tutari * ((100+config('cart.tax')) / 100) }}</td>
        </tr>
        <tr>
            <th colspan="4" class="text-right">Sipariş Durum</th>
            <td colspan="2">{{ $siparis->durum }}</td>
        </tr>
    </table>

@endsection