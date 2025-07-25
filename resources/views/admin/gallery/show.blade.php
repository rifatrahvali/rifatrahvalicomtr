@extends('layouts.admin')
@section('title', 'Galeri Detayı')
@section('content')
<div class="container mx-auto py-8">
    <div class="max-w-xl mx-auto bg-white rounded shadow p-6">
        <h2 class="text-2xl font-bold mb-4">Galeri Öğesi Detayı</h2>
        @if($gallery->type === 'image')
            <img src="{{ asset('storage/' . $gallery->path) }}" alt="{{ $gallery->alt_text ?? $gallery->title }}" class="w-full h-64 object-cover rounded mb-4" loading="lazy">
            <!-- Türkçe: Görsel detayda lazy loading ve alt_text kullanıldı. -->
        @else
            <video width="100%" height="260" controls class="rounded mb-4">
                <source src="{{ asset('storage/' . $gallery->path) }}" type="video/mp4">
                Tarayıcınız video etiketini desteklemiyor.
            </video>
            <!-- Türkçe: Video detayda erişilebilir şekilde gösterildi. -->
        @endif
        <div class="mb-2"><strong>Başlık:</strong> {{ $gallery->title }}</div>
        <div class="mb-2"><strong>Açıklama:</strong> {{ $gallery->description }}</div>
        <div class="mb-2"><strong>Tür:</strong> <span class="badge {{ $gallery->type === 'image' ? 'badge-success' : 'badge-info' }}">{{ $gallery->type === 'image' ? 'Görsel' : 'Video' }}</span></div>
        <div class="mb-2"><strong>Sıra:</strong> {{ $gallery->order }}</div>
        <div class="mb-2"><strong>Alt Text (SEO):</strong> {{ $gallery->alt_text }}</div>
        <a href="{{ route('admin.gallery.index') }}" class="btn btn-secondary mt-4">Geri Dön</a>
    </div>
</div>
@endsection 