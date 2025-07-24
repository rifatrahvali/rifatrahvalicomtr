@extends('layouts.app')

@section('content')
<div class="container py-5" style="max-width: 800px;">
    <div class="mb-4">
        <a href="{{ route('blog.index') }}" class="btn btn-light border rounded-pill px-4 py-2 mb-3" style="font-size: 15px;">&larr; Tüm Yazılar</a>
        <h1 class="fw-bold mb-2" style="font-size: 2.2rem; color: #1e293b;">{{ $post->title }}</h1>
        <div class="d-flex flex-wrap align-items-center gap-3 mb-3" style="font-size: 14px; color: #64748b;">
            <span>📅 {{ $post->published_at ? $post->published_at->format('d M Y') : $post->created_at->format('d M Y') }}</span>
            @if($post->category)
                <span>|</span>
                <a href="{{ route('blog.category', $post->category->slug) }}" class="badge bg-gradient-primary text-white px-3 py-2" style="background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%); font-size: 13px;">🏷️ {{ $post->category->name }}</a>
            @endif
            <span>|</span>
            <span title="Tahmini okuma süresi">⏱️ {{ $post->readingTime() }} dk okuma</span>
        </div>
        @if($post->tags->count())
            <div class="mb-2">
                @foreach($post->tags as $tag)
                    <a href="{{ route('blog.tag', $tag->slug) }}" class="badge bg-light text-secondary border me-1 mb-1" style="font-size: 12px;">#{{ $tag->name }}</a>
                @endforeach
            </div>
        @endif
    </div>
    @if($post->image)
        <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="img-fluid rounded shadow mb-4" style="max-height: 400px; object-fit: cover; width: 100%;">
    @else
        <img src="/images/placeholder-blog.jpg" alt="Placeholder" class="img-fluid rounded shadow mb-4" style="max-height: 400px; object-fit: cover; width: 100%;">
    @endif
    <div class="blog-content mb-4" style="font-size: 1.13rem; line-height: 1.9; color: #374151;">
        {!! $post->content !!}
    </div>
    <div class="mb-4">
        <span class="me-2">Paylaş:</span>
        <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($post->title) }}" target="_blank" rel="noopener" class="btn btn-sm btn-outline-info me-1">Twitter</a>
        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" target="_blank" rel="noopener" class="btn btn-sm btn-outline-primary me-1">Facebook</a>
        <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(request()->fullUrl()) }}&title={{ urlencode($post->title) }}" target="_blank" rel="noopener" class="btn btn-sm btn-outline-secondary">LinkedIn</a>
    </div>
</div>
@endsection
<!-- Türkçe yorum: Blog detay sayfası modern, görsel odaklı ve okunabilir şekilde tasarlandı. Başlık, görsel, meta bilgiler, kategori, etiketler, içerik ve sosyal paylaşım butonları içerir. --> 