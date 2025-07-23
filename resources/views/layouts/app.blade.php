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
    <!-- Vite/Tailwind/Bootstrap -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Türkçe: Modern CSS/JS dosyaları dahil edildi -->
</head>
<body class="bg-gray-50 text-gray-900 min-h-screen flex flex-col">
    <!-- Türkçe: Header bileşeni -->
    @include('components.partials.header')
    <!-- Türkçe: Navigation bileşeni -->
    @include('components.partials.navigation')
    <!-- Türkçe: Breadcrumb bileşeni ana menünün hemen altında gösterilir. -->
    @include('components.partials.breadcrumb')
    <main class="flex-1 container mx-auto px-4 py-6">
        @yield('content')
    </main>
    <!-- Türkçe: Footer bileşeni -->
    @include('components.partials.footer')
</body>
</html>
