@extends('yonetim.layouts.master')
@section('title','Kullanıcı Yönetimi')
@section('content')

    <h1 class="page-header">Kullanıcı Yönetimi</h1>
    <h3 class="sub-header">Kullanıcı Listesi</h3>
    <div class="well">
        <div class="btn-group pull-right">
            <a href="{{ route('yonetim.kullanici.yeni') }}" class="btn btn-primary">Kullanıcı Ekle</a>
        </div>
        <form method="post" action="{{ route('yonetim.kullanici') }}" class="form-inline">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="aranan">Ara</label>
                <input type="text" class="form-control form-control-sm" name="aranan" id="aranan" placeholder="Ad, Email Ara..." value="{{ old('aranan') }}">
            </div>
            <button type="submit" class="btn btn-primary">Ara</button>
            <a href="{{ route('yonetim.kullanici') }}" class="btn btn-primary">Temizle</a>
        </form>
    </div>

    @include('layouts.partials.alert')

    <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Ad Soyad</th>
                <th>Email</th>
                <th>Durum</th>
                <th>Rol</th>
                <th>Kayıt Tarihi</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($kullanicilar as $kullanici)
                <tr>
                    <td>{{ $kullanici->id }}</td>
                    <td>{{ $kullanici->adsoyad }}</td>
                    <td>{{ $kullanici->email }}</td>
                    <td>
                        @if($kullanici->aktif_mi)
                            <span class="label label-success">Aktif</span>
                        @else
                            <span class="label label-danger">Pasif</span>
                        @endif
                    </td>
                    <td>
                        @if($kullanici->yonetici_mi)
                            <span class="label label-success">Yönetici</span>
                        @else
                            <span class="label label-primary">Müşteri</span>
                        @endif
                    </td>
                    <td>{{ $kullanici->olusturma_tarihi }}</td>
                    <td style="width: 100px">
                        <a href="{{ route('yonetim.kullanici.duzenle',$kullanici->id) }}" class="btn btn-xs btn-success" data-toggle="tooltip" data-placement="top" title="Düzenle">
                            <span class="fa fa-pencil"></span>
                        </a>
                        <a href="{{ route('yonetim.kullanici.sil',$kullanici->id) }}" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Sil" onclick="return confirm('Emin misiniz?')">
                            <span class="fa fa-trash"></span>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $kullanicilar->links() }}
    </div>

@endsection