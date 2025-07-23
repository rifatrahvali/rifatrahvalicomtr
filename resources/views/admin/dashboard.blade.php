@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="mb-3">Yönetim Paneline Hoşgeldiniz</h2>
            <p class="lead">Buradan site içeriğini ve ayarlarını yönetebilirsiniz.</p>
        </div>
    </div>
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Kullanıcılar</h5>
                    <p class="card-text">Kullanıcı yönetimi ve roller.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">İçerik</h5>
                    <p class="card-text">Blog, CV, Galeri ve Referanslar yönetimi.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Ayarlar</h5>
                    <p class="card-text">Site genel ayarları ve yapılandırma.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Türkçe yorum: Dashboard ana sayfa, yönetim paneli karşılama ve özet kartları -->
@endsection 