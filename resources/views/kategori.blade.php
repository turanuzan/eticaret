@extends('layouts.master')
@section('title',$kategori->kategori_adi)
@section('content')

    <div class="container">
        <ol class="breadcrumb">
            <li><a href="{{ route('anasayfa') }}">Anasayfa</a></li>
            <li class="active">{{ $kategori->kategori_adi }}</li>
        </ol>
        <div class="row">
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $kategori->kategori_adi }}</div>
                    <div class="panel-body">
                        <h3>Alt Kategoriler</h3>
                        <div class="list-group categories">
                            @foreach($alt_kategoriler as $alt_kategori)
                                <a href="{{ route('kategori',$alt_kategori->slug) }}" class="list-group-item">
                                    <i class="fa fa-arrow-circle-right"></i>
                                    {{ $alt_kategori->kategori_adi }}
                                </a>
                            @endforeach
                        </div>
                        {{--<h3>Fiyat Aralığı</h3>
                        <form>
                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox"> 100-200
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox"> 200-300
                                    </label>
                                </div>
                            </div>
                        </form>--}}
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="products bg-content">
                    Sırala
                    <a href="#" class="btn btn-default">Çok Satanlar</a>
                    <a href="#" class="btn btn-default">Yeni Ürünler</a>
                    <hr>
                    <div class="row">
                        <div class="col-md-3 product">
                            <a href="#"><img src="http://placekitten.com/400/400?image=1"></a>
                            <p><a href="#">Ürün adı</a></p>
                            <p class="price">129 ₺</p>
                            <p><a href="#" class="btn btn-theme">Sepete Ekle</a></p>
                        </div>
                        <div class="col-md-3 product">
                            <a href="#"><img src="http://placekitten.com/400/400?image=2"></a>
                            <p><a href="#">Ürün adı</a></p>
                            <p class="price">129 ₺</p>
                            <p><a href="#" class="btn btn-theme">Sepete Ekle</a></p>
                        </div>
                        <div class="col-md-3 product">
                            <a href="#"><img src="http://placekitten.com/400/400?image=3"></a>
                            <p><a href="#">Ürün adı</a></p>
                            <p class="price">129 ₺</p>
                            <p><a href="#" class="btn btn-theme">Sepete Ekle</a></p>
                        </div>
                        <div class="col-md-3 product">
                            <a href="#"><img src="http://placekitten.com/400/400?image=4"></a>
                            <p><a href="#">Ürün adı</a></p>
                            <p class="price">129 ₺</p>
                            <p><a href="#" class="btn btn-theme">Sepete Ekle</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection