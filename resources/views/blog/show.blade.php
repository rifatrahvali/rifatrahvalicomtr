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
    <article id="blog-article">
        <h1>{{ $post->title }}</h1>
        <div class="mb-2 text-muted small">
            <span>{{ $post->published_at ? $post->published_at->format('d M Y') : $post->created_at->format('d M Y') }}</span>
            @if($post->category)
                | <a href="{{ route('blog.category', $post->category->slug) }}">{{ $post->category->name }}</a>
            @endif
            | <span title="Tahmini okuma süresi">⏱️ {{ $post->readingTime() }} dk okuma</span>
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
            <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(request()->fullUrl()) }}&title={{ urlencode($post->title) }}" target="_blank" rel="noopener" class="btn btn-sm btn-outline-secondary">LinkedIn</a>
            <button onclick="window.print()" class="btn btn-sm btn-outline-dark ms-2">Yazdır</button>
        </div>
        <div class="progress mb-4 d-none d-print-none" id="read-progress-bar" style="height: 6px;">
            <div class="progress-bar bg-success" role="progressbar" style="width: 0%"></div>
        </div>
        @if($relatedPosts->count())
        <div class="mb-4">
            <h5>İlgili Yazılar</h5>
            <ul class="list-unstyled">
                @foreach($relatedPosts as $related)
                    <li class="mb-2">
                        <a href="{{ route('blog.show', $related->slug) }}">{{ $related->title }}</a>
                        <span class="text-muted small">({{ $related->published_at ? $related->published_at->format('d M Y') : $related->created_at->format('d M Y') }})</span>
                    </li>
                @endforeach
            </ul>
        </div>
        @endif
    </article>
</div>
@push('scripts')
<script>
// Okuma ilerleme çubuğu
window.addEventListener('scroll', function() {
    var article = document.getElementById('blog-article');
    var bar = document.getElementById('read-progress-bar').querySelector('.progress-bar');
    var rect = article.getBoundingClientRect();
    var winHeight = window.innerHeight;
    var docHeight = article.offsetHeight;
    var scrollTop = window.scrollY || window.pageYOffset;
    var articleTop = article.offsetTop;
    var percent = 0;
    if (scrollTop + winHeight > articleTop) {
        var scrolled = Math.min(scrollTop + winHeight - articleTop, docHeight);
        percent = Math.max(0, Math.min(100, (scrolled / docHeight) * 100));
    }
    bar.style.width = percent + '%';
});
// Türkçe yorum: Kullanıcı yazıyı okudukça ilerleme çubuğu güncellenir.
</script>
<style>
/* Print-friendly stil */
@media print {
    body * { visibility: hidden !important; }
    #blog-article, #blog-article * { visibility: visible !important; }
    #blog-article { position: absolute; left: 0; top: 0; width: 100%; background: #fff; }
    .btn, .progress, .badge, .d-print-none { display: none !important; }
}
</style>
@endpush
@endsection

{{-- Türkçe yorum: Tekil blog yazısı detay sayfası, başlık, kategori, etiket, içerik ve sosyal paylaşım içerir. --}} 