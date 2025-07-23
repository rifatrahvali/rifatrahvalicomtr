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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/prismjs@1.29.0/themes/prism.min.css">
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
            <picture>
                <source srcset="{{ asset('storage/uploads/webp/' . pathinfo($post->image, PATHINFO_FILENAME) . '.webp') }}" type="image/webp">
                <img src="{{ asset('storage/' . $post->image) }}"
                     srcset="{{ asset('storage/' . $post->image) }} 800w, {{ asset('storage/uploads/thumbnails/' . basename($post->image)) }} 150w, {{ asset('storage/uploads/medium/' . basename($post->image)) }} 400w"
                     sizes="(max-width: 600px) 100vw, (max-width: 1200px) 50vw, 33vw"
                     class="img-fluid rounded mb-3"
                     alt="{{ $post->title }}"
                     loading="lazy">
            </picture>
            <!-- Türkçe yorum: WebP desteği, responsive srcset ve picture etiketi ile optimize görsel sunumu -->
        @endif
        <div class="mb-4 blog-content">
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
<script src="https://cdn.jsdelivr.net/npm/prismjs@1.29.0/prism.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/prismjs@1.29.0/components/prism-php.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/prismjs@1.29.0/components/prism-javascript.min.js"></script>
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
// Türkçe: Kullanıcı yazıyı okudukça ilerleme çubuğu güncellenir.

// Lightbox: Blog içeriğindeki img'lere tıklanınca büyük göster
// Türkçe: Basit lightbox fonksiyonu
if(document.querySelector('.blog-content')){
    document.querySelectorAll('.blog-content img').forEach(function(img) {
        img.style.cursor = 'zoom-in';
        img.addEventListener('click', function() {
            var overlay = document.createElement('div');
            overlay.style.position = 'fixed';
            overlay.style.top = 0;
            overlay.style.left = 0;
            overlay.style.width = '100vw';
            overlay.style.height = '100vh';
            overlay.style.background = 'rgba(0,0,0,0.85)';
            overlay.style.display = 'flex';
            overlay.style.alignItems = 'center';
            overlay.style.justifyContent = 'center';
            overlay.style.zIndex = 9999;
            var bigImg = document.createElement('img');
            bigImg.src = img.src;
            bigImg.style.maxWidth = '90vw';
            bigImg.style.maxHeight = '90vh';
            bigImg.style.borderRadius = '1rem';
            bigImg.style.boxShadow = '0 8px 32px rgba(0,0,0,0.3)';
            overlay.appendChild(bigImg);
            overlay.addEventListener('click', function() { document.body.removeChild(overlay); });
            document.body.appendChild(overlay);
        });
    });
}
</script>
<style>
/* Print-friendly stil */
@media print {
    body * { visibility: hidden !important; }
    #blog-article, #blog-article * { visibility: visible !important; }
    #blog-article { position: absolute; left: 0; top: 0; width: 100%; background: #fff; }
    .btn, .progress, .badge, .d-print-none { display: none !important; }
}
/* Türkçe: Blog tipografi ve kod blokları için özel stil */
.blog-content {
    font-family: var(--font-sans);
    font-size: 1.08rem;
    line-height: 1.8;
    color: var(--gray-800);
    max-width: 700px;
    margin: 0 auto;
}
.blog-content h2, .blog-content h3, .blog-content h4 {
    font-family: var(--font-heading);
    font-weight: 700;
    margin-top: 2rem;
    margin-bottom: 1rem;
    color: var(--color-primary);
}
.blog-content blockquote {
    border-left: 4px solid var(--color-accent);
    background: var(--gray-50);
    padding: 1rem 1.5rem;
    margin: 1.5rem 0;
    color: var(--gray-600);
    font-style: italic;
}
.blog-content pre {
    background: #23272e;
    color: #fff;
    border-radius: 0.5rem;
    padding: 1rem;
    overflow-x: auto;
    margin: 1.5rem 0;
    font-size: 0.98em;
}
.blog-content code {
    background: var(--gray-100);
    color: var(--color-danger);
    border-radius: 0.3em;
    padding: 0.15em 0.4em;
    font-size: 0.98em;
}
.blog-content pre code {
    background: none;
    color: inherit;
    padding: 0;
}
.blog-content ul, .blog-content ol {
    margin-left: 2rem;
    margin-bottom: 1.2rem;
}
.blog-content img {
    max-width: 100%;
    border-radius: 0.5rem;
    margin: 1.5rem 0;
    box-shadow: 0 2px 12px rgba(0,0,0,0.07);
    transition: box-shadow 0.2s;
}
.blog-content img:hover {
    box-shadow: 0 8px 32px rgba(0,0,0,0.18);
}
.blog-content .gallery {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    gap: 1rem;
    margin: 2rem 0;
}
</style>
@endpush
{{-- Türkçe yorum: Tekil blog yazısı detay sayfası, başlık, kategori, etiket, içerik ve sosyal paylaşım içerir. --}}
@endsection 