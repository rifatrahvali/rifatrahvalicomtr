<!-- Türkçe: Modern navigasyon menüsü (inline CSS ile) -->
<nav style="background: linear-gradient(135deg, #2563eb 0%, #7c3aed 100%); box-shadow: 0 10px 25px rgba(0,0,0,0.1);" role="navigation" aria-label="Ana menü">
    <div style="max-width: 1200px; margin: 0 auto; padding: 16px;">
        <ul style="display: flex; flex-wrap: wrap; gap: 24px; justify-content: center; list-style: none; margin: 0; padding: 0;">
            <li>
                <a href="/" style="color: white; text-decoration: none; padding: 12px 24px; border-radius: 8px; font-weight: 500; transition: all 0.3s ease; display: inline-block; @if(request()->is('/')) background: rgba(255,255,255,0.2); font-weight: 600; @endif" 
                   onmouseover="this.style.background='rgba(255,255,255,0.1)'; this.style.color='#dbeafe';" 
                   onmouseout="this.style.background='@if(request()->is('/')) rgba(255,255,255,0.2) @else transparent @endif'; this.style.color='white';">
                    Anasayfa
                </a>
            </li>
            <li>
                <a href="/cv" style="color: white; text-decoration: none; padding: 12px 24px; border-radius: 8px; font-weight: 500; transition: all 0.3s ease; display: inline-block; @if(request()->is('cv')) background: rgba(255,255,255,0.2); font-weight: 600; @endif" 
                   onmouseover="this.style.background='rgba(255,255,255,0.1)'; this.style.color='#dbeafe';" 
                   onmouseout="this.style.background='@if(request()->is('cv')) rgba(255,255,255,0.2) @else transparent @endif'; this.style.color='white';">
                    CV
                </a>
            </li>
            <li>
                <a href="/blog" style="color: white; text-decoration: none; padding: 12px 24px; border-radius: 8px; font-weight: 500; transition: all 0.3s ease; display: inline-block; @if(request()->is('blog*')) background: rgba(255,255,255,0.2); font-weight: 600; @endif" 
                   onmouseover="this.style.background='rgba(255,255,255,0.1)'; this.style.color='#dbeafe';" 
                   onmouseout="this.style.background='@if(request()->is('blog*')) rgba(255,255,255,0.2) @else transparent @endif'; this.style.color='white';">
                    Blog
                </a>
            </li>
            <li>
                <a href="/gallery" style="color: white; text-decoration: none; padding: 12px 24px; border-radius: 8px; font-weight: 500; transition: all 0.3s ease; display: inline-block; @if(request()->is('gallery*')) background: rgba(255,255,255,0.2); font-weight: 600; @endif" 
                   onmouseover="this.style.background='rgba(255,255,255,0.1)'; this.style.color='#dbeafe';" 
                   onmouseout="this.style.background='@if(request()->is('gallery*')) rgba(255,255,255,0.2) @else transparent @endif'; this.style.color='white';">
                    Galeri
                </a>
            </li>
            <li>
                <a href="/references" style="color: white; text-decoration: none; padding: 12px 24px; border-radius: 8px; font-weight: 500; transition: all 0.3s ease; display: inline-block; @if(request()->is('references*')) background: rgba(255,255,255,0.2); font-weight: 600; @endif" 
                   onmouseover="this.style.background='rgba(255,255,255,0.1)'; this.style.color='#dbeafe';" 
                   onmouseout="this.style.background='@if(request()->is('references*')) rgba(255,255,255,0.2) @else transparent @endif'; this.style.color='white';">
                    Referanslar
                </a>
            </li>
            <li>
                <a href="/contact" style="color: white; text-decoration: none; padding: 12px 24px; border-radius: 8px; font-weight: 500; transition: all 0.3s ease; display: inline-block; @if(request()->is('contact')) background: rgba(255,255,255,0.2); font-weight: 600; @endif" 
                   onmouseover="this.style.background='rgba(255,255,255,0.1)'; this.style.color='#dbeafe';" 
                   onmouseout="this.style.background='@if(request()->is('contact')) rgba(255,255,255,0.2) @else transparent @endif'; this.style.color='white';">
                    İletişim
                </a>
            </li>
        </ul>
    </div>
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