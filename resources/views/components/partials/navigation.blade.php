<!-- Türkçe: Modern navigasyon menüsü (inline CSS ile, mobil uyumlu) -->
<nav style="background: linear-gradient(135deg, #2563eb 0%, #7c3aed 100%); box-shadow: 0 10px 25px rgba(0,0,0,0.1);" role="navigation" aria-label="Ana menü">
    <div style="max-width: 1200px; margin: 0 auto; padding: 16px; position: relative;">
        <!-- Türkçe: Hamburger buton (sadece mobilde görünür) -->
        <button id="mobile-menu-toggle" aria-label="Menüyü Aç/Kapat" aria-expanded="false" style="display:none; position:absolute; left:16px; top:16px; background:none; border:none; z-index:20; padding:8px; cursor:pointer;">
            <span style="display:block; width:28px; height:4px; background:white; margin:5px 0; border-radius:2px;"></span>
            <span style="display:block; width:28px; height:4px; background:white; margin:5px 0; border-radius:2px;"></span>
            <span style="display:block; width:28px; height:4px; background:white; margin:5px 0; border-radius:2px;"></span>
        </button>
        <ul id="main-nav-list" style="display: flex; flex-wrap: wrap; gap: 24px; justify-content: center; list-style: none; margin: 0; padding: 0; transition: all 0.3s; background: none;">
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
        <!-- Türkçe: Çıkış (X) butonu, sadece menü açıkken ve mobilde görünür -->
        <button id="mobile-menu-close" aria-label="Menüyü Kapat" style="display:none; position:fixed; top:32px; right:24px; background:none; border:none; z-index:9999; font-size:2.2rem; color:white; cursor:pointer; line-height:1;">
            &times;
        </button>
    </div>
</nav>
<style>
@media (max-width: 768px) {
    nav[role="navigation"] > div {
        min-height: 80px; /* Türkçe: Arka plan daha aşağı çekildi */
        background: linear-gradient(135deg, #2563eb 0%, #7c3aed 100%);
        position: relative;
        z-index: 20;
    }
    #mobile-menu-toggle {
        display: block !important;
        position: absolute !important;
        top: 16px !important;
        left: 16px !important;
        z-index: 30 !important;
    }
    #mobile-menu-close {
        display: none !important;
    }
    #main-nav-list {
        display: none !important;
        flex-direction: column !important;
        gap: 0 !important;
        background: linear-gradient(135deg, #2563eb 0%, #7c3aed 100%);
        position: absolute;
        top: 80px;
        left: 0;
        width: 100%;
        z-index: 10;
        padding: 8px 0;
    }
    #main-nav-list.open {
        display: flex !important;
        position: fixed !important;
        top: 0 !important;
        left: 0 !important;
        width: 100vw !important;
        height: 100vh !important;
        background: linear-gradient(135deg, #2563eb 0%, #7c3aed 100%) !important;
        align-items: flex-start !important;
        justify-content: flex-start !important;
        padding-top: 88px !important;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        z-index: 100;
    }
    #main-nav-list li {
        width: 100%;
        text-align: left;
    }
    #main-nav-list a {
        width: 100%;
        display: block;
        padding: 16px 24px !important;
        border-radius: 0 !important;
    }
    /* Menü açıkken hamburger butonunu gizle, X butonunu göster */
    #main-nav-list.open ~ #mobile-menu-toggle {
        display: none !important;
    }
    #main-nav-list.open ~ #mobile-menu-close {
        display: block !important;
    }
}
</style>
<script>
// Türkçe: Hamburger ve X butonları ile menü aç/kapat (sadece mobilde)
const btn = document.getElementById('mobile-menu-toggle');
const closeBtn = document.getElementById('mobile-menu-close');
const menu = document.getElementById('main-nav-list');
if(btn && menu && closeBtn){
    btn.addEventListener('click', function() {
        menu.classList.toggle('open');
        btn.setAttribute('aria-expanded', menu.classList.contains('open') ? 'true' : 'false');
        if(menu.classList.contains('open')){
            btn.style.display = 'none';
            closeBtn.style.display = 'block';
            document.body.style.overflow = 'hidden';
        } else {
            btn.style.display = 'block';
            closeBtn.style.display = 'none';
            document.body.style.overflow = '';
        }
    });
    closeBtn.addEventListener('click', function() {
        menu.classList.remove('open');
        btn.setAttribute('aria-expanded', 'false');
        btn.style.display = 'block';
        closeBtn.style.display = 'none';
        document.body.style.overflow = '';
    });
    menu.querySelectorAll('a').forEach(function(link){
        link.addEventListener('click', function(){
            menu.classList.remove('open');
            btn.setAttribute('aria-expanded', 'false');
            btn.style.display = 'block';
            closeBtn.style.display = 'none';
            document.body.style.overflow = '';
        });
    });
}
</script>
<!-- Türkçe: Menü açıldığında sağ üstte Çıkış (X) butonu eklenmiştir. --> 