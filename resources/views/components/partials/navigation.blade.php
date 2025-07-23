<nav class="bg-gray-100 border-b" role="navigation" aria-label="Ana menü">
    <div class="container mx-auto flex items-center justify-between px-4 py-2">
        <ul class="hidden md:flex gap-6">
            <li><a href="/" class="nav-link @if(request()->is('/')) nav-active @endif">Anasayfa</a></li>
            <li><a href="/cv" class="nav-link @if(request()->is('cv')) nav-active @endif">CV</a></li>
            <li><a href="/blog" class="nav-link @if(request()->is('blog*')) nav-active @endif">Blog</a></li>
            <li><a href="/gallery" class="nav-link @if(request()->is('gallery*')) nav-active @endif">Galeri</a></li>
            <li><a href="/references" class="nav-link @if(request()->is('references*')) nav-active @endif">Referanslar</a></li>
            <li><a href="/contact" class="nav-link @if(request()->is('contact')) nav-active @endif">İletişim</a></li>
        </ul>
        <!-- Hamburger Menü (Mobil) -->
        <button class="md:hidden flex items-center" id="mobile-menu-toggle" aria-label="Menüyü Aç/Kapat" aria-expanded="false" aria-controls="mobile-menu-list">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
        </button>
    </div>
    <ul id="mobile-menu-list" class="md:hidden hidden flex-col gap-2 px-4 pb-4" role="menu">
        <li><a href="/" class="nav-link @if(request()->is('/')) nav-active @endif" role="menuitem">Anasayfa</a></li>
        <li><a href="/cv" class="nav-link @if(request()->is('cv')) nav-active @endif" role="menuitem">CV</a></li>
        <li><a href="/blog" class="nav-link @if(request()->is('blog*')) nav-active @endif" role="menuitem">Blog</a></li>
        <li><a href="/gallery" class="nav-link @if(request()->is('gallery*')) nav-active @endif" role="menuitem">Galeri</a></li>
        <li><a href="/references" class="nav-link @if(request()->is('references*')) nav-active @endif" role="menuitem">Referanslar</a></li>
        <li><a href="/contact" class="nav-link @if(request()->is('contact')) nav-active @endif" role="menuitem">İletişim</a></li>
    </ul>
    <!-- Türkçe: Bu bileşen ana navigasyon menüsünü ve mobilde hamburger menüyü içerir. -->
</nav>
<script>
// Türkçe: Mobil menü açma/kapama fonksiyonu
const btn = document.getElementById('mobile-menu-toggle');
const menu = document.getElementById('mobile-menu-list');
if(btn && menu){
    btn.addEventListener('click', function() {
        const isOpen = menu.classList.toggle('hidden') === false;
        btn.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
    });
}
</script> 