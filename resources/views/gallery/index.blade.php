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
        <!-- Türkçe yorum: Modern dropdown filtre tasarımı -->
    </form>

    <!-- Modern Galeri Grid -->
    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 16px; margin-bottom: 32px;">
        @foreach($galleries as $item)
            <div style="background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%); border-radius: 16px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); overflow: hidden; border: 1px solid #e2e8f0; transition: all 0.3s ease; position: relative;" onmouseover="this.style.transform='translateY(-8px) scale(1.02)'; this.style.boxShadow='0 25px 50px rgba(0,0,0,0.2)';" onmouseout="this.style.transform='translateY(0) scale(1)'; this.style.boxShadow='0 10px 25px rgba(0,0,0,0.1)';" data-type="{{ $item->type }}">
                
                @if($item->type == 'image')
                    <!-- Görsel İçeriği -->
                    <div style="position: relative; overflow: hidden; height: 250px; cursor: pointer;" onclick="openLightbox('{{ asset('storage/' . $item->path) }}', '{{ $item->title }}')">
                        <!-- Türkçe yorum: Basitleştirilmiş görsel yükleme sistemi -->
                        @php
                            $cdn = config('media.cdn_url');
                            $getCdnUrl = function($path) use ($cdn) {
                                return $cdn ? rtrim($cdn, '/') . '/' . ltrim($path, '/') : asset('storage/' . $path);
                            };
                        @endphp
                        <img src="{{ $getCdnUrl($item->path) }}"
                             srcset="{{ $getCdnUrl('uploads/thumbnails/' . basename($item->path)) }} 150w, {{ $getCdnUrl('uploads/medium/' . basename($item->path)) }} 400w, {{ $getCdnUrl('uploads/large/' . basename($item->path)) }} 800w"
                             sizes="(max-width: 600px) 100vw, (max-width: 1200px) 50vw, 33vw"
                             style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s ease;"
                             alt="{{ $item->alt_text ?? $item->title }}"
                             loading="lazy"
                             onerror="this.src='https://via.placeholder.com/400x250/8b5cf6/ffffff?text=🖼️+Görsel+Yüklenemedi'"
                             onmouseover="this.style.transform='scale(1.1)';"
                             onmouseout="this.style.transform='scale(1)';">
                        
                        <!-- Hover Overlay -->
                        <div style="position: absolute; inset: 0px; background: linear-gradient(135deg, rgba(139, 92, 246, 0.8) 0%, rgba(124, 58, 237, 0.6) 100%); opacity: 0; transition: opacity 0.3s; display: flex; align-items: center; justify-content: center; flex-direction: column; gap: 8px;" onmouseover="this.style.opacity='1';" onmouseout="this.style.opacity='0';">
                            <span style="color: white; font-size: 32px;">🔍</span>
                            <span style="color: white; font-size: 14px; font-weight: 600;">Büyüt</span>
                        </div>
                        <!-- Türkçe yorum: Hover efekti ile büyütme ikonu gösterimi -->
                        
                        <!-- Tip Badge -->
                        <div style="position: absolute; top: 12px; left: 12px; background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%); color: white; padding: 4px 8px; border-radius: 6px; font-size: 11px; font-weight: 600;">
                            🖼️ Görsel
                        </div>
                    </div>
                    <!{{-- Türkçe yorum: Modern galeri sayfası, görseller ve videoları modern card tasarımıyla listeler, lightbox desteği ile. --}}ve lightbox ile -->
                    
                @else
                    <!-- Video İçeriği -->
                    <div style="position: relative; height: 250px;">
                        <video controls style="width: 100%; height: 100%; object-fit: cover; border-radius: 0;">
                            <source src="{{ asset('storage/' . $item->path) }}" type="video/mp4">
                            Tarayıcınız video etiketini desteklemiyor.
                        </video>
                        
                        <!-- Tip Badge -->
                        <div style="position: absolute; top: 12px; left: 12px; background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); color: white; padding: 4px 8px; border-radius: 6px; font-size: 11px; font-weight: 600;">
                            🎥 Video
                        </div>
                    </div>
                    <!-- Türkçe yorum: Modern video player tasarımı -->
                @endif
                
                <!-- İçerik Bilgileri -->
                <div style="padding: 20px;">
                    <h3 style="font-size: 16px; font-weight: 700; color: #1e293b; margin-bottom: 8px; line-height: 1.4;">{{ $item->title }}</h3>
                    @if($item->description)
                        <p style="color: #64748b; font-size: 13px; line-height: 1.5; margin: 0;">{{ \Illuminate\Support\Str::limit($item->description, 80) }}</p>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    <!-- Modern Sayfalama -->
    @if($galleries->hasPages())
        <div style="display: flex; justify-content: center; margin-top: 48px;">
            <div style="background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%); border-radius: 12px; box-shadow: 0 8px 20px rgba(0,0,0,0.1); padding: 16px; border: 1px solid #e2e8f0;">
                {{ $galleries->withQueryString()->links() }}
            </div>
        </div>
    @endif
</div>

<!-- Lightbox Modal -->
<div id="lightbox" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.9); z-index: 9999; cursor: pointer;" onclick="closeLightbox()">
    <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); max-width: 90%; max-height: 90%;">
        <img id="lightbox-img" style="max-width: 100%; max-height: 100%; border-radius: 8px; box-shadow: 0 25px 50px rgba(0,0,0,0.5);">
        <div id="lightbox-title" style="text-align: center; color: white; margin-top: 16px; font-size: 18px; font-weight: 600;"></div>
    </div>
    <button onclick="closeLightbox()" style="position: absolute; top: 20px; right: 20px; background: rgba(255,255,255,0.2); color: white; border: none; width: 40px; height: 40px; border-radius: 50%; font-size: 20px; cursor: pointer; backdrop-filter: blur(10px);">×</button>
</div>

<script>
// Lightbox fonksiyonları
function openLightbox(src, title) {
    document.getElementById('lightbox').style.display = 'block';
    document.getElementById('lightbox-img').src = src;
    document.getElementById('lightbox-title').textContent = title;
    document.body.style.overflow = 'hidden';
}

function closeLightbox() {
    document.getElementById('lightbox').style.display = 'none';
    document.body.style.overflow = 'auto';
}

// ESC tuşu ile kapat
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeLightbox();
    }
});
</script>
<!-- Türkçe yorum: Modern lightbox modal ve JavaScript kontrolleri -->
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