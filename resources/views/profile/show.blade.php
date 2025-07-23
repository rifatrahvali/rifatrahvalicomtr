@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Profilim</h1>
    <ul>
        <li><strong>Ad Soyad:</strong> {{ $user->name }}</li>
        <li><strong>E-posta:</strong> {{ $user->email }}</li>
        <li><strong>Başlık:</strong> {{ $user->profile->title ?? '-' }}</li>
        <li><strong>Telefon:</strong> {{ $user->profile->phone ?? '-' }}</li>
        <li><strong>Web Sitesi:</strong> {{ $user->profile->website ?? '-' }}</li>
        <li><strong>Adres:</strong> {{ $user->profile->address ?? '-' }}</li>
        <li><strong>Kısa Özgeçmiş:</strong> {{ $user->about->bio ?? '-' }}</li>
    </ul>
</div>
@endsection
{{-- Türkçe: Kullanıcı profilini gösteren basit bir sayfa. --}} 