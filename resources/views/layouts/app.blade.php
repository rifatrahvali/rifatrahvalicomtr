<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'rifatrahvali.com.tr')</title>
    <meta name="description" content="@yield('meta_description', 'Kişisel blog ve portföy - rifatrahvali.com.tr')">
    @stack('meta') <!-- Türkçe: SEO ve sosyal medya meta alanları için -->
    <link rel="icon" type="image/png" href="/favicon.ico">
    <link rel="manifest" href="/manifest.json">
    <script>
      // Türkçe: Service worker kaydı ile PWA offline desteği
      if ('serviceWorker' in navigator) {
        window.addEventListener('load', function() {
          navigator.serviceWorker.register('/service-worker.js');
        });
      }
    </script>
    <!-- Türkçe: PWA manifest ve service worker eklenmiştir. -->
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Vite/Tailwind/Bootstrap -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="preload" as="font" href="https://fonts.bunny.net/css?family=Nunito" crossorigin>
    <link rel="prefetch" as="script" href="{{ asset('build/assets/app.js') }}">
    <!-- Türkçe: Vite ile assetler tek satırda eklenir, Vite::asset fonksiyonu kullanılmaz. -->
    
    <!-- Global Image Fallback Script -->
    <script>
    // Türkçe: Tüm kırık görseller için otomatik fallback
    document.addEventListener('DOMContentLoaded', function() {
        // Mevcut tüm img etiketleri için fallback ekle
        document.querySelectorAll('img').forEach(function(img) {
            if (!img.hasAttribute('data-fallback-added')) {
                img.setAttribute('data-fallback-added', 'true');
                img.addEventListener('error', function() {
                    // Görsel türüne göre uygun placeholder seç
                    let fallbackSrc = '/images/placeholder-gallery.jpg';
                    if (img.src.includes('blog') || img.alt.toLowerCase().includes('blog')) {
                        fallbackSrc = '/images/placeholder-blog.jpg';
                    } else if (img.src.includes('project') || img.alt.toLowerCase().includes('proje')) {
                        fallbackSrc = '/images/placeholder-project.jpg';
                    }
                    
                    // Sonsuz döngüyü önlemek için kontrol
                    if (this.src !== window.location.origin + fallbackSrc) {
                        this.src = fallbackSrc;
                    }
                });
            }
        });
        
        // Dinamik olarak eklenen img etiketleri için observer
        const observer = new MutationObserver(function(mutations) {
            mutations.forEach(function(mutation) {
                mutation.addedNodes.forEach(function(node) {
                    if (node.nodeType === 1) {
                        const imgs = node.tagName === 'IMG' ? [node] : node.querySelectorAll('img');
                        imgs.forEach(function(img) {
                            if (!img.hasAttribute('data-fallback-added')) {
                                img.setAttribute('data-fallback-added', 'true');
                                img.addEventListener('error', function() {
                                    let fallbackSrc = '/images/placeholder-gallery.jpg';
                                    if (img.src.includes('blog') || img.alt.toLowerCase().includes('blog')) {
                                        fallbackSrc = '/images/placeholder-blog.jpg';
                                    } else if (img.src.includes('project') || img.alt.toLowerCase().includes('proje')) {
                                        fallbackSrc = '/images/placeholder-project.jpg';
                                    }
                                    if (this.src !== window.location.origin + fallbackSrc) {
                                        this.src = fallbackSrc;
                                    }
                                });
                            }
                        });
                    }
                });
            });
        });
        
        observer.observe(document.body, { childList: true, subtree: true });
    });
    </script>
</head>
<body class="bg-gray-50 text-gray-900 min-h-screen flex flex-col">
    <!-- Türkçe: Header bileşeni -->
    @include('components.partials.header')
    <!-- Türkçe: Navigasyon, header bileşenine taşındı -->
    <!-- Türkçe: Breadcrumb bileşeni ana menünün hemen altında gösterilir. -->
    @include('components.partials.breadcrumb')
    <main class="flex-1 container mx-auto px-4 py-6">
        @yield('content')
    </main>
    <!-- Türkçe: Footer bileşeni -->
    @include('components.partials.footer')
</body>
</html>
