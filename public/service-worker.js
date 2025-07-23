// Türkçe: Basit bir service worker ile temel offline desteği
self.addEventListener('install', function(event) {
  self.skipWaiting();
  // Türkçe: Service worker yüklendiğinde hemen aktif olur
});

self.addEventListener('activate', function(event) {
  // Türkçe: Service worker aktif olduğunda eski cache'ler temizlenebilir
});

self.addEventListener('fetch', function(event) {
  event.respondWith(
    caches.match(event.request).then(function(response) {
      return response || fetch(event.request);
    })
  );
  // Türkçe: Önce cache'den, yoksa ağdan veri getirir
}); 