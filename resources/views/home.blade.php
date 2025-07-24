@extends('layouts.app')
@section('title', 'Ana Sayfa | rifatrahvali.com.tr')
@section('content')
<!-- Modern Hero Alanı (inline CSS ile) -->
<section style="position: relative; overflow: hidden; border-radius: 16px; margin-top: 64px; margin-bottom: 64px; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);">
    <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0;">
        <img src="/images/hero-background.jpg" alt="Telif Hakkı Olmayan Manzara Görseli" style="width: 100%; height: 100%; object-fit: cover;">
        <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: linear-gradient(135deg, rgba(30, 58, 138, 0.8) 0%, rgba(91, 33, 182, 0.6) 100%);"></div>
    </div>
    <div style="position: relative; z-index: 10; padding: 60px 16px; text-align: center; color: white;">
        <div style="max-width: 1024px; margin: 0 auto;">
            <h1 style="font-size: clamp(2rem, 5vw, 3.5rem); font-weight: bold; margin-bottom: 24px; background: linear-gradient(135deg, #dbeafe 0%, #e9d5ff 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; line-height: 1.1;">
                Merhaba, ben Rıfat Rahvalı
            </h1>
            <p style="font-size: clamp(1rem, 3vw, 1.5rem); margin-bottom: 32px; color: #dbeafe; line-height: 1.6;">
                Web geliştirici, blog yazarı ve teknoloji tutkunu.
            </p>
            <div style="display: flex; flex-direction: column; gap: 16px; justify-content: center; align-items: center;">
                <a href="/cv" style="background: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 100%); color: white; padding: 14px 28px; border-radius: 50px; font-weight: 600; text-decoration: none; transition: all 0.3s ease; display: inline-block; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1); font-size: clamp(14px, 2.5vw, 16px); width: fit-content; min-width: 200px;" 
                   onmouseover="this.style.transform='scale(1.05)'; this.style.background='linear-gradient(135deg, #2563eb 0%, #7c3aed 100%)';" 
                   onmouseout="this.style.transform='scale(1)'; this.style.background='linear-gradient(135deg, #3b82f6 0%, #8b5cf6 100%)';" 
                   aria-label="CV Sayfasına Git">
                    👤 CV'mi Görüntüle
                </a>
                <a href="/blog" style="background: rgba(255,255,255,0.1); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.2); color: white; padding: 14px 28px; border-radius: 50px; font-weight: 600; text-decoration: none; transition: all 0.3s ease; display: inline-block; font-size: clamp(14px, 2.5vw, 16px); width: fit-content; min-width: 200px;" 
                   onmouseover="this.style.background='rgba(255,255,255,0.2)';" 
                   onmouseout="this.style.background='rgba(255,255,255,0.1)';" 
                   aria-label="Blog Sayfasına Git">
                    📝 Blog'umu Keşfet
                </a>
            </div>
        </div>
    </div>
</section>
<!-- Türkçe: Hero alanı, kişisel tanıtım ve call-to-action içerir. -->

<!-- Modern CV Özeti -->
@if($profil)
<section style="margin-bottom: 48px; background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%); border-radius: 16px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); padding: 32px; border: 1px solid #e2e8f0;">
    <div style="display: flex; align-items: center; gap: 16px; margin-bottom: 24px;">
        <div style="width: 48px; height: 48px; background: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
            <span style="color: white; font-size: 20px;">👨‍💼</span>
        </div>
        <h2 style="font-size: 24px; font-weight: 700; color: #1e293b; margin: 0;">Kısa Özgeçmiş</h2>
    </div>
    <p style="color: #64748b; font-size: 16px; line-height: 1.6; margin-bottom: 20px;">{{ $profil->bio ?? 'Kısa özgeçmiş bilgisi henüz eklenmedi.' }}</p>
    <a href="/cv" style="background: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 100%); color: white; padding: 12px 24px; border-radius: 8px; text-decoration: none; font-weight: 600; display: inline-block; transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 10px 20px rgba(59,130,246,0.3)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';">
        📄 Detaylı CV'yi Gör
    </a>
</section>
@endif
<!-- Türkçe: Modern CV özeti bölümü, gradient arkaplan ve hover efektleriyle -->

<!-- Modern Son Blog Yazıları -->
<section style="margin-bottom: 48px;">
    <div style="display: flex; align-items: center; gap: 16px; margin-bottom: 32px;">
        <div style="width: 48px; height: 48px; background: linear-gradient(135deg, #10b981 0%, #059669 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
            <span style="color: white; font-size: 20px;">📝</span>
        </div>
        <h2 style="font-size: 24px; font-weight: 700; color: #1e293b; margin: 0;">Son Blog Yazıları</h2>
    </div>
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px;">
        @forelse($bloglar as $blog)
            <div style="background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%); border-radius: 16px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); padding: 24px; border: 1px solid #e2e8f0; transition: all 0.3s ease; position: relative; overflow: hidden;" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 20px 40px rgba(0,0,0,0.15)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 10px 25px rgba(0,0,0,0.1)';">
                <div style="position: absolute; top: 0; left: 0; width: 100%; height: 4px; background: linear-gradient(135deg, #10b981 0%, #059669 100%);"></div>
                <h3 style="font-size: 18px; font-weight: 700; color: #1e293b; margin-bottom: 12px; line-height: 1.4;">{{ $blog->title }}</h3>
                <p style="color: #64748b; font-size: 14px; line-height: 1.6; margin-bottom: 16px;">{{ \Illuminate\Support\Str::limit($blog->summary, 80) }}</p>
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <span style="font-size: 12px; color: #94a3b8; background: #f1f5f9; padding: 4px 8px; border-radius: 6px;">📅 {{ $blog->created_at->format('d.m.Y') }}</span>
                    <a href="/blog/{{ $blog->slug }}" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; padding: 8px 16px; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 14px; transition: all 0.3s ease;" onmouseover="this.style.background='linear-gradient(135deg, #059669 0%, #047857 100)';" onmouseout="this.style.background='linear-gradient(135deg, #10b981 0%, #059669 100)';">
                        Devamını Oku →
                    </a>
                </div>
            </div>
        @empty
            <div style="grid-column: 1 / -1; text-align: center; color: #64748b; font-size: 16px; padding: 48px; background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%); border-radius: 16px; border: 2px dashed #cbd5e1;">
                <div style="font-size: 48px; margin-bottom: 16px;">📝</div>
                <p style="margin: 0;">Henüz blog yazısı eklenmedi.</p>
            </div>
        @endforelse
    </div>
</section>
<!-- Türkçe: Modern blog yazıları bölümü, card tasarımı ve hover efektleriyle -->

<!-- Modern Portföy/Galeri Öne Çıkanlar -->
<section style="margin-bottom: 48px;">
    <div style="display: flex; align-items: center; gap: 16px; margin-bottom: 32px;">
        <div style="width: 48px; height: 48px; background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
            <span style="color: white; font-size: 20px;">🎨</span>
        </div>
        <h2 style="font-size: 24px; font-weight: 700; color: #1e293b; margin: 0;">Öne Çıkan Projeler</h2>
    </div>
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 20px;">
        @forelse($galeriler as $g)
            <div style="background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%); border-radius: 16px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); overflow: hidden; border: 1px solid #e2e8f0; transition: all 0.3s ease; position: relative;" onmouseover="this.style.transform='translateY(-8px) scale(1.02)'; this.style.boxShadow='0 25px 50px rgba(0,0,0,0.2)';" onmouseout="this.style.transform='translateY(0) scale(1)'; this.style.boxShadow='0 10px 25px rgba(0,0,0,0.1)';">
                <div style="position: relative; overflow: hidden;">
                    <img src="{{ $g->path ?? '/images/placeholder-gallery.jpg' }}" alt="{{ $g->title }}" style="width: 100%; height: 200px; object-fit: cover; transition: transform 0.3s ease;" onmouseover="this.style.transform='scale(1.1)';" onmouseout="this.style.transform='scale(1)';">
                    <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: linear-gradient(135deg, rgba(139, 92, 246, 0.8) 0%, rgba(124, 58, 237, 0.6) 100%); opacity: 0; transition: opacity 0.3s ease; display: flex; align-items: center; justify-content: center;" onmouseover="this.style.opacity='1';" onmouseout="this.style.opacity='0';">
                        <span style="color: white; font-size: 24px;">🔍</span>
                    </div>
                </div>
                <div style="padding: 20px;">
                    <h3 style="font-size: 18px; font-weight: 700; color: #1e293b; margin-bottom: 12px; line-height: 1.4;">{{ $g->title }}</h3>
                    <p style="color: #64748b; font-size: 14px; margin-bottom: 16px;">{{ $g->description ?? 'Proje açıklaması henüz eklenmedi.' }}</p>
                    <a href="/gallery" style="background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%); color: white; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 14px; display: inline-block; transition: all 0.3s ease;" onmouseover="this.style.background='linear-gradient(135deg, #7c3aed 0%, #6d28d9 100)'; this.style.transform='translateY(-2px)';" onmouseout="this.style.background='linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100)'; this.style.transform='translateY(0)';">
                        🖼️ Galeriye Git
                    </a>
                </div>
            </div>
        @empty
            <div style="grid-column: 1 / -1; text-align: center; color: #64748b; font-size: 16px; padding: 48px; background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%); border-radius: 16px; border: 2px dashed #cbd5e1;">
                <div style="font-size: 48px; margin-bottom: 16px;">🎨</div>
                <p style="margin: 0;">Henüz galeri içeriği eklenmedi.</p>
            </div>
        @endforelse
    </div>
</section>
<!-- Türkçe: Modern galeri bölümü, görsel hover efektleri ve card tasarımıyla -->

<!-- Modern İletişim ve Sosyal Medya -->
<section style="margin-bottom: 48px; text-align: center;">
    <div style="display: flex; align-items: center; justify-content: center; gap: 16px; margin-bottom: 32px;">
        <div style="width: 48px; height: 48px; background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
            <span style="color: white; font-size: 20px;">📞</span>
        </div>
        <h2 style="font-size: 24px; font-weight: 700; color: #1e293b; margin: 0;">İletişim & Sosyal Medya</h2>
    </div>
    <div style="background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%); border-radius: 16px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); padding: 32px; border: 1px solid #e2e8f0; max-width: 600px; margin: 0 auto;">
        <p style="color: #64748b; font-size: 16px; margin-bottom: 24px; line-height: 1.6;">Benimle iletişime geçmek için aşağıdaki kanalları kullanabilirsiniz:</p>
        <div style="display: flex; flex-wrap: wrap; gap: 16px; justify-content: center; align-items: center;">
            <a href="mailto:info@rifatrahvali.com.tr" style="background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%); color: white; padding: 12px 20px; border-radius: 10px; text-decoration: none; font-weight: 600; display: flex; align-items: center; gap: 8px; transition: all 0.3s ease; box-shadow: 0 4px 12px rgba(220, 38, 38, 0.3);" aria-label="E-posta ile iletişim" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 20px rgba(220, 38, 38, 0.4)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(220, 38, 38, 0.3)';">
                <span style="font-size: 18px;">📧</span>
                <span>E-posta</span>
            </a>
            <a href="https://twitter.com/rifatrahvali" target="_blank" rel="noopener" style="background: linear-gradient(135deg, #1d9bf0 0%, #1a8cd8 100%); color: white; padding: 12px 20px; border-radius: 10px; text-decoration: none; font-weight: 600; display: flex; align-items: center; gap: 8px; transition: all 0.3s ease; box-shadow: 0 4px 12px rgba(29, 155, 240, 0.3);" aria-label="Twitter" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 20px rgba(29, 155, 240, 0.4)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(29, 155, 240, 0.3)';">
                <span style="font-size: 18px;">🐦</span>
                <span>Twitter</span>
            </a>
            <a href="https://github.com/rifatrahvali" target="_blank" rel="noopener" style="background: linear-gradient(135deg, #374151 0%, #1f2937 100%); color: white; padding: 12px 20px; border-radius: 10px; text-decoration: none; font-weight: 600; display: flex; align-items: center; gap: 8px; transition: all 0.3s ease; box-shadow: 0 4px 12px rgba(55, 65, 81, 0.3);" aria-label="GitHub" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 20px rgba(55, 65, 81, 0.4)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(55, 65, 81, 0.3)';">
                <span style="font-size: 18px;">💻</span>
                <span>GitHub</span>
            </a>
        </div>
    </div>
</section>
<!-- Türkçe: Modern iletişim bölümü, renkli butonlar ve hover efektleriyle -->
@endsection
