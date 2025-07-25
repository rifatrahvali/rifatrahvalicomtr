@extends('layouts.app')
@section('content')
<!-- Modern Galeri Sayfası -->
<div style="max-width: 1200px; margin: 0 auto; padding: 24px 12px;">
    <!-- Modern Başlık Bölümü -->
    <div style="text-align: center; margin-bottom: 32px;">
        <div style="display: flex; align-items: center; justify-content: center; gap: 16px; margin-bottom: 16px;">
            <div style="width: 48px; height: 48px; background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                <span style="color: white; font-size: 20px;">🎨</span>
            </div>
            <h1 style="font-size: clamp(24px, 5vw, 32px); font-weight: 700; color: #1e293b; margin: 0;">Galeri</h1>
        </div>
        <p style="color: #64748b; font-size: clamp(14px, 3vw, 16px); margin: 0;">Görseller, videolar ve yaratıcı çalışmalar</p>
    </div>

    <!-- Modern Filtre Bölümü -->
    <form method="GET" style="margin-bottom: 32px;">
        <div style="display: flex; justify-content: center;">
            <div style="background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%); border-radius: 12px; box-shadow: 0 8px 20px rgba(0,0,0,0.1); padding: 8px; border: 1px solid #e2e8f0;">
                <select name="category" style="background: transparent; border: none; padding: 12px 20px; border-radius: 8px; font-weight: 600; color: #1e293b; cursor: pointer; font-size: 14px; outline: none;" onchange="this.form.submit()">
                    <option value="" style="background: white;">🇺🇸 Tümü</option>
                    <option value="image" {{ $category == 'image' ? 'selected' : '' }} style="background: white;">🖼️ Görseller</option>
                    <option value="video" {{ $category == 'video' ? 'selected' : '' }} style="background: white;">🎥 Videolar</option>
                </select>
            </div>
        </div>
        <!-- Türkçe: Modern dropdown filtre tasarımı -->
    </form>

    <!-- Modern Galeri Grid -->
    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 16px; margin-bottom: 32px;">
        @foreach($galleries as $item)
            <div style="background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%); border-radius: 16px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); overflow: hidden; border: 1px solid #e2e8f0; transition: all 0.3s ease; position: relative;" data-type="{{ $item->type }}">
                @if($item->type == 'image')
                    <a href="{{ asset('storage/' . $item->path) }}" class="gallery-lightbox" data-title="{{ $item->title }}">
                        <img src="{{ asset('storage/' . $item->path) }}" alt="{{ $item->alt_text ?? $item->title }}" loading="lazy" style="width: 100%; height: 220px; object-fit: cover; border-radius: 16px 16px 0 0; cursor: pointer;" onerror="this.onerror=null;this.src='https://via.placeholder.com/400x220?text=Yok';" />
                    </a>
                    <!-- Türkçe: Görsel bozuksa placeholder gösterilir. -->
                @else
                    <video width="100%" height="220" controls style="border-radius: 16px 16px 0 0;">
                        <source src="{{ asset('storage/' . $item->path) }}" type="video/mp4">
                        Tarayıcınız video etiketini desteklemiyor.
                    </video>
                    <!-- Türkçe: Video içeriği erişilebilir şekilde gösterildi. -->
                @endif
                <div style="padding: 16px;">
                    <div style="font-weight: 600; color: #1e293b; font-size: 18px; margin-bottom: 6px;">{{ $item->title }}</div>
                    <div style="color: #64748b; font-size: 14px; margin-bottom: 8px;">{{ $item->description }}</div>
                    <span style="font-size: 12px; color: #7c3aed; font-weight: 500;">{{ $item->type == 'image' ? 'Görsel' : 'Video' }}</span>
                </div>
            </div>
        @endforeach
    </div>
    <div style="text-align: center;">
        {{ $galleries->links() }}
        <!-- Türkçe: Sayfalama -->
    </div>
</div>

<!-- Lightbox Modal -->
<div id="lightbox" style="display: none; position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background: rgba(0,0,0,0.9); z-index: 9999; align-items: center; justify-content: center;">
    <img id="lightbox-img" src="" alt="" style="max-width: 90vw; max-height: 80vh; border-radius: 12px; box-shadow: 0 8px 32px rgba(0,0,0,0.5);">
    <div id="lightbox-title" style="color: white; text-align: center; margin-top: 16px; font-size: 18px; font-weight: 600;"></div>
    <button onclick="closeLightbox()" style="position: absolute; top: 32px; right: 32px; background: rgba(255,255,255,0.2); color: white; border: none; width: 40px; height: 40px; border-radius: 50%; font-size: 24px; cursor: pointer;">×</button>
</div>
<script>
// Türkçe: Basit vanilla JS ile lightbox/modal açma
function openLightbox(src, title) {
    document.getElementById('lightbox-img').src = src;
    document.getElementById('lightbox-title').textContent = title;
    document.getElementById('lightbox').style.display = 'flex';
    document.body.style.overflow = 'hidden';
}
function closeLightbox() {
    document.getElementById('lightbox').style.display = 'none';
    document.body.style.overflow = 'auto';
}
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.gallery-lightbox').forEach(function(link) {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            openLightbox(this.href, this.getAttribute('data-title'));
        });
    });
    document.getElementById('lightbox').addEventListener('click', function(e) {
        if (e.target === this) closeLightbox();
    });
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeLightbox();
    });
});
</script>
<!-- Türkçe: Görsele tıklanınca büyük boyutlu lightbox açılır. -->
@endsection 