@extends('layouts.app')
@section('content')
<div class="container py-4">
    <h1 class="mb-4">Galeri</h1>
    <form method="GET" class="mb-4">
        <select name="category" class="form-select w-auto d-inline" onchange="this.form.submit()">
            <option value="">Tümü</option>
            <option value="image" {{ $category == 'image' ? 'selected' : '' }}>Görseller</option>
            <option value="video" {{ $category == 'video' ? 'selected' : '' }}>Videolar</option>
        </select>
        <!-- Türkçe yorum: Kategoriye göre filtreleme dropdown'u -->
    </form>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
        @foreach($galleries as $item)
            <div class="col">
                <div class="card h-100 gallery-item" data-type="{{ $item->type }}">
                    @if($item->type == 'image')
                        <a href="{{ asset('storage/' . $item->path) }}" class="gallery-lightbox" data-title="{{ $item->title }}">
                            <img src="{{ asset('storage/' . $item->path) }}" class="card-img-top" alt="{{ $item->alt_text ?? $item->title }}" loading="lazy">
                        </a>
                        <!-- Türkçe yorum: Görsel için lightbox linki ve lazy loading -->
                    @else
                        <video controls class="w-100">
                            <source src="{{ asset('storage/' . $item->path) }}" type="video/mp4">
                            Tarayıcınız video etiketini desteklemiyor.
                        </video>
                        <!-- Türkçe yorum: Video için video player -->
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->title }}</h5>
                        <p class="card-text small">{{ $item->description }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="mt-4">
        {{ $galleries->withQueryString()->links() }}
        <!-- Türkçe yorum: Sayfalama -->
    </div>
</div>
<!-- Lightbox için basit JS -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.gallery-lightbox').forEach(function(link) {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const img = document.createElement('img');
            img.src = this.href;
            img.alt = this.getAttribute('data-title');
            img.style.maxWidth = '90vw';
            img.style.maxHeight = '90vh';
            const overlay = document.createElement('div');
            overlay.style.position = 'fixed';
            overlay.style.top = 0;
            overlay.style.left = 0;
            overlay.style.width = '100vw';
            overlay.style.height = '100vh';
            overlay.style.background = 'rgba(0,0,0,0.8)';
            overlay.style.display = 'flex';
            overlay.style.alignItems = 'center';
            overlay.style.justifyContent = 'center';
            overlay.style.zIndex = 9999;
            overlay.appendChild(img);
            overlay.addEventListener('click', function() {
                document.body.removeChild(overlay);
            });
            document.body.appendChild(overlay);
        });
    });
});
</script>
<!-- Türkçe yorum: Basit vanilla JS ile lightbox/modal açma -->
@endsection 