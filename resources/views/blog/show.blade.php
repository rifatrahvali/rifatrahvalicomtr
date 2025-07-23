@extends('layouts.app')

@section('title', $post->title . ' | rifatrahvali.com.tr')
@section('meta_description', Str::limit(strip_tags($post->content), 150))
@push('head')
    <meta name="description" content="{{ Str::limit(strip_tags($post->content), 150) }}">
    <!-- Open Graph Meta -->
    <meta property="og:title" content="{{ $post->title }}" />
    <meta property="og:description" content="{{ Str::limit(strip_tags($post->content), 150) }}" />
    <meta property="og:type" content="article" />
    <meta property="og:url" content="{{ request()->fullUrl() }}" />
    @if($post->image)
        <meta property="og:image" content="{{ asset('storage/' . $post->image) }}" />
    @endif
    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="{{ $post->title }}" />
    <meta name="twitter:description" content="{{ Str::limit(strip_tags($post->content), 150) }}" />
    @if($post->image)
        <meta name="twitter:image" content="{{ asset('storage/' . $post->image) }}" />
    @endif
    <!-- JSON-LD Structured Data -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Article",
      "headline": "{{ $post->title }}",
      "description": "{{ Str::limit(strip_tags($post->content), 150) }}",
      "image": "{{ $post->image ? asset('storage/' . $post->image) : '' }}",
      "datePublished": "{{ $post->published_at ? $post->published_at->toAtomString() : $post->created_at->toAtomString() }}",
      "author": {
        "@type": "Person",
        "name": "Rifat Rahvali"
      }
    }
    </script>
@endpush

@section('content')
<div class="container py-4">
    <div class="mb-3">
        <a href="{{ route('blog.index') }}" class="btn btn-link">&larr; Tüm Yazılar</a>
    </div>
    <article>
        <h1>{{ $post->title }}</h1>
        <div class="mb-2 text-muted small">
            <span>{{ $post->published_at ? $post->published_at->format('d M Y') : $post->created_at->format('d M Y') }}</span>
            @if($post->category)
                | <a href="{{ route('blog.category', $post->category->slug) }}">{{ $post->category->name }}</a>
            @endif
        </div>
        <div class="mb-2">
            @foreach($post->tags as $tag)
                <a href="{{ route('blog.tag', $tag->slug) }}" class="badge bg-secondary text-decoration-none">#{{ $tag->name }}</a>
            @endforeach
        </div>
        @if($post->image)
            <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid rounded mb-3" alt="{{ $post->title }}">
        @endif
        <div class="mb-4">
            {!! $post->content !!}
        </div>
        <div class="mb-4">
            <span class="me-2">Paylaş:</span>
            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($post->title) }}" target="_blank" rel="noopener" class="btn btn-sm btn-outline-info">Twitter</a>
            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" target="_blank" rel="noopener" class="btn btn-sm btn-outline-primary">Facebook</a>
        </div>
    </article>
</div>
@endsection

{{-- Türkçe yorum: Tekil blog yazısı detay sayfası, başlık, kategori, etiket, içerik ve sosyal paylaşım içerir. --}} 