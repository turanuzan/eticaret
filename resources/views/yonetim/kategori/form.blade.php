@extends('yonetim.layouts.master')
@section('title','Kategori Yönetimi')
@section('content')
    <h1 class="page-header">Kategori Yönetimi</h1>

    <form action="{{ route('yonetim.kategori.kaydet',@$kategori->id) }}" method="post">
        {{ csrf_field() }}
        <div class="pull-right">
            <button type="submit" class="btn btn-primary">{{ @$kategori->id > 0 ? "Güncelle" : "Kaydet" }}</button>
        </div>
        <h3 class="sub-header">Kategori {{ @$kategori->id > 0 ? "Düzenle" : "Ekle" }}</h3>

        @include('layouts.partials.errors')
        @include('layouts.partials.alert')

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="ust_id">Üst Kategori</label>
                    <select name="ust_id" id="ust_id" class="form-control">
                        <option value="">Ana Kategori</option>
                        @foreach($kategoriler as $value)
                            <option value="{{ $value->id }}">{{ $value->kategori_adi }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="kategori_adi">Kategori Adı</label>
                    <input type="text" class="form-control" id="kategori_adi" name="kategori_adi" placeholder="Kategori Adı" value="{{ old('kategori_adi',@$kategori->kategori_adi) }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="slug">Slug</label>
                    <input type="hidden" name="orginal_slug" value="{{ old('slug',@$kategori->slug) }}">
                    <input type="text" class="form-control" id="slug" name="slug" placeholder="Slug" value="{{ old('slug',@$kategori->slug) }}">
                </div>
            </div>
        </div>

    </form>
@endsection