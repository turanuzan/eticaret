@extends('yonetim.layouts.master')
@section('title','Ürün Yönetimi')
@section('content')
    <h1 class="page-header">Ürün Yönetimi</h1>

    <form action="{{ route('yonetim.urun.kaydet',@$urun->id) }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="pull-right">
            <button type="submit" class="btn btn-primary">{{ @$urun->id > 0 ? "Güncelle" : "Kaydet" }}</button>
        </div>
        <h3 class="sub-header">Ürün {{ @$urun->id > 0 ? "Düzenle" : "Ekle" }}</h3>

        @include('layouts.partials.errors')
        @include('layouts.partials.alert')

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="urun_adi">Ürün Adı</label>
                    <input type="text" class="form-control" id="urun_adi" name="urun_adi" placeholder="Ürün Adı" value="{{ old('urun_adi',@$urun->urun_adi) }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="slug">Slug</label>
                    <input type="hidden" name="orginal_slug" value="{{ old('slug',@$urun->slug) }}">
                    <input type="text" class="form-control" id="slug" name="slug" placeholder="Slug" value="{{ old('slug',@$urun->slug) }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="aciklama">Açıklama</label>
                    <textarea class="form-control" id="aciklama" name="aciklama" placeholder="Açıklama">{{ old('aciklama',@$urun->aciklama) }}</textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="fiyati">Fiyatı</label>
                    <input type="text" class="form-control" id="fiyati" name="fiyati" placeholder="Fiyatı" value="{{ old('fiyati',@$urun->fiyati) }}">
                </div>
            </div>
        </div>
        <div class="checkbox">
            <label>
                <input type="hidden" name="goster_slider" value="0">
                <input type="checkbox" name="goster_slider" value="1" {{ old('goster_slider', @$urun->detay->goster_slider) ? 'checked' : '' }}> Slider'da Göster
            </label>
            <label>
                <input type="hidden" name="goster_gunun_firsati" value="0">
                <input type="checkbox" name="goster_gunun_firsati" value="1" {{ old('goster_gunun_firsati', @$urun->detay->goster_gunun_firsati) ? 'checked' : '' }}> Günün Fırsatında Göster
            </label>
            <label>
                <input type="hidden" name="goster_one_cikan" value="0">
                <input type="checkbox" name="goster_one_cikan" value="1" {{ old('goster_one_cikan', @$urun->detay->goster_one_cikan) ? 'checked' : '' }}> Öne Çıkan Alanında Göster
            </label>
            <label>
                <input type="hidden" name="goster_cok_satan" value="0">
                <input type="checkbox" name="goster_cok_satan" value="1" {{ old('goster_cok_satan', @$urun->detay->goster_cok_satan) ? 'checked' : '' }}> Çok Satan Ürünlerde Göster
            </label>
            <label>
                <input type="hidden" name="goster_indirimli" value="0">
                <input type="checkbox" name="goster_indirimli" value="1" {{ old('goster_indirimli', @$urun->detay->goster_indirimli) ? 'checked' : '' }}> İndirimli Ürünlerde Göster
            </label>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="kategoriler">Kategoriler</label>
                    <select name="kategoriler[]" id="kategoriler" class="form-control" multiple>
                        @foreach($kategoriler as $kategori)
                            <option value="{{ $kategori->id }}" {{ collect(old('kategoriler',$urun_kategoriler))->contains($kategori->id) ? 'selected' : '' }}>{{ $kategori->kategori_adi }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group">
            @if($urun->detay->urun_resmi != null)
                <img src="/uploads/urunler/{{ $urun->detay->urun_resmi }}" style="height: 100px; margin-right: 20px;" class="thumbnail pull-left">
            @endif
            <label for="urun_resmi">Ürün Resmi</label>
            <input type="file" name="urun_resmi" id="urun_resmi">
        </div>
    </form>
@endsection

@section('head')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
@endsection

@section('footer')
    <script src="//cdn.ckeditor.com/4.10.0/standard/ckeditor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.10.0/plugins/autogrow/plugin.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script>
        $(function(){
           $('#kategoriler').select2({
               placeholder: 'Kategori Seçiniz'
           });

           var options = {
               uiColor: '#f4645f',
               language: 'tr',
               extraPlugins: 'autogrow',
               autoGrow_minHeight: 250,
               autoGrow_maxHeight: 600,
               filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
               filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
               filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
               filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
           }

           CKEDITOR.replace('aciklama', options);
        });
    </script>
@endsection