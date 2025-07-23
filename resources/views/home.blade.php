@extends('layouts.app')
@section('title', 'Ana Sayfa | rifatrahvali.com.tr')
@section('content')
<!-- Hero Alanı -->
<section class="flex flex-col md:flex-row items-center gap-8 mb-12">
    <img src="/favicon.ico" alt="Profil Fotoğrafı" class="w-32 h-32 rounded-full shadow">
    <div>
        <h1 class="text-3xl font-bold mb-2">Merhaba, ben Rıfat Rahvali</h1>
        <p class="text-gray-600 mb-4">Web geliştirici, blog yazarı ve teknoloji tutkunu.</p>
        <a href="/cv" class="btn btn-primary" aria-label="CV Sayfasına Git">CV'mi Görüntüle</a>
    </div>
</section>
<!-- Türkçe: Hero alanı, kişisel tanıtım ve call-to-action içerir. -->

<!-- CV Özeti -->
@if($profil)
<section class="mb-12 bg-white rounded shadow p-6">
    <h2 class="text-xl font-semibold mb-2">Kısa Özgeçmiş</h2>
    <p class="mb-2">{{ $profil->bio ?? 'Kısa özgeçmiş bilgisi henüz eklenmedi.' }}</p>
    <a href="/cv" class="text-blue-600 hover:underline">Detaylı CV'yi Gör</a>
</section>
@endif
<!-- Türkçe: CV özeti bölümü, profil modelinden alınan kısa bilgiyle gösterilir. -->

<!-- Son Blog Yazıları -->
<section class="mb-12">
    <h2 class="text-xl font-semibold mb-4">Son Blog Yazıları</h2>
    <div class="grid md:grid-cols-3 gap-6">
        @forelse($bloglar as $blog)
            <div class="bg-white rounded shadow p-4 flex flex-col">
                <h3 class="font-bold text-lg mb-2">{{ $blog->title }}</h3>
                <p class="text-gray-600 mb-2">{{ \Illuminate\Support\Str::limit($blog->summary, 80) }}</p>
                <span class="text-xs text-gray-400 mb-2">{{ $blog->created_at->format('d.m.Y') }}</span>
                <a href="/blog/{{ $blog->slug }}" class="mt-auto text-blue-600 hover:underline">Devamını Oku</a>
            </div>
        @empty
            <div class="col-span-3 text-gray-500">Henüz blog yazısı eklenmedi.</div>
        @endforelse
    </div>
</section>
<!-- Türkçe: Son 3 blog yazısı başlık, özet ve link ile gösterilir. -->

<!-- Portföy/Galeri Öne Çıkanlar -->
<section class="mb-12">
    <h2 class="text-xl font-semibold mb-4">Öne Çıkan Projeler</h2>
    <div class="grid md:grid-cols-3 gap-6">
        @forelse($galeriler as $g)
            <div class="bg-white rounded shadow p-4 flex flex-col items-center">
                <img src="{{ $g->path ?? '/favicon.ico' }}" alt="{{ $g->title }}" class="w-full h-32 object-cover rounded mb-2">
                <h3 class="font-bold text-lg mb-2">{{ $g->title }}</h3>
                <a href="/gallery" class="text-blue-600 hover:underline">Galeriye Git</a>
            </div>
        @empty
            <div class="col-span-3 text-gray-500">Henüz galeri içeriği eklenmedi.</div>
        @endforelse
    </div>
</section>
<!-- Türkçe: Son 3 galeri içeriği görsel, başlık ve link ile gösterilir. -->

<!-- İletişim ve Sosyal Medya -->
<section class="mb-12 text-center">
    <h2 class="text-xl font-semibold mb-4">İletişim & Sosyal Medya</h2>
    <div class="flex flex-col md:flex-row gap-4 justify-center items-center">
        <a href="mailto:info@rifatrahvali.com.tr" class="text-blue-700 hover:underline" aria-label="E-posta ile iletişim">info@rifatrahvali.com.tr</a>
        <a href="https://twitter.com/rifatrahvali" target="_blank" rel="noopener" class="text-blue-500 hover:underline" aria-label="Twitter">Twitter</a>
        <a href="https://github.com/rifatrahvali" target="_blank" rel="noopener" class="text-gray-800 hover:underline" aria-label="GitHub">GitHub</a>
    </div>
</section>
<!-- Türkçe: İletişim ve sosyal medya linkleri erişilebilir şekilde gösterilir. -->
@endsection
