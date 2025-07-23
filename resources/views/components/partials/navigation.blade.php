<nav class="bg-gray-100 border-b">
    <div class="container mx-auto flex items-center justify-between px-4 py-2">
        <ul class="hidden md:flex gap-6">
            <li><a href="/" class="hover:text-blue-600 font-medium @if(request()->is('/')) text-blue-700 @endif">Anasayfa</a></li>
            <li><a href="/cv" class="hover:text-blue-600 font-medium @if(request()->is('cv')) text-blue-700 @endif">CV</a></li>
            <li><a href="/blog" class="hover:text-blue-600 font-medium @if(request()->is('blog*')) text-blue-700 @endif">Blog</a></li>
            <li><a href="/gallery" class="hover:text-blue-600 font-medium @if(request()->is('gallery*')) text-blue-700 @endif">Galeri</a></li>
            <li><a href="/references" class="hover:text-blue-600 font-medium @if(request()->is('references*')) text-blue-700 @endif">Referanslar</a></li>
            <li><a href="/contact" class="hover:text-blue-600 font-medium @if(request()->is('contact')) text-blue-700 @endif">İletişim</a></li>
        </ul>
        <!-- Hamburger Menü (Mobil) -->
        <button class="md:hidden flex items-center" id="mobile-menu-toggle" aria-label="Menüyü Aç/Kapat">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
        </button>
    </div>
    <!-- Türkçe: Bu bileşen ana navigasyon menüsünü ve mobilde hamburger menüyü içerir. -->
</nav>
<script>
// Türkçe: Mobil menü açma/kapama fonksiyonu
const btn = document.getElementById('mobile-menu-toggle');
if(btn){
    btn.addEventListener('click', function() {
        // Burada mobil menü açma/kapama işlemleri yapılabilir.
        alert('Mobil menü açma/kapama fonksiyonu buraya eklenecek.');
    });
}
</script> 