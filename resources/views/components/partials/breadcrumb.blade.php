@php
// Türkçe: Modern breadcrumb için route segmentlerini işle ve çevir
$segments = request()->segments();
$breadcrumbMap = [
    'blog' => ['name' => 'Blog', 'icon' => '📝'],
    'gallery' => ['name' => 'Galeri', 'icon' => '🎨'],
    'cv' => ['name' => 'CV', 'icon' => '📄'],
    'references' => ['name' => 'Referanslar', 'icon' => '🤝'],
    'contact' => ['name' => 'İletişim', 'icon' => '📞'],
    'about' => ['name' => 'Hakkımda', 'icon' => '👨‍💼'],
];
@endphp

@if(count($segments) > 0 && !request()->is('/'))
<!-- Modern Breadcrumb Navigasyonu -->
<nav style="background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%); border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); padding: 16px 24px; margin: 24px auto; max-width: 1200px; border: 1px solid #e2e8f0;" aria-label="Breadcrumb">
    <div style="display: flex; align-items: center; gap: 8px; flex-wrap: wrap;">
        <!-- Ana Sayfa -->
        <a href="/" style="display: flex; align-items: center; gap: 6px; color: #64748b; text-decoration: none; font-size: 14px; font-weight: 500; padding: 6px 12px; border-radius: 6px; transition: all 0.3s ease;" onmouseover="this.style.background='#f1f5f9'; this.style.color='#3b82f6';" onmouseout="this.style.background='transparent'; this.style.color='#64748b';">
            <span style="font-size: 16px;">🏠</span>
            <span>Anasayfa</span>
        </a>
        
        @foreach($segments as $index => $segment)
            <!-- Ayıraç -->
            <span style="color: #cbd5e1; font-size: 14px; font-weight: 500;">›</span>
            
            @if($index + 1 < count($segments))
                <!-- Ara Link -->
                <a href="/{{ implode('/', array_slice($segments, 0, $index+1)) }}" style="display: flex; align-items: center; gap: 6px; color: #64748b; text-decoration: none; font-size: 14px; font-weight: 500; padding: 6px 12px; border-radius: 6px; transition: all 0.3s ease;" onmouseover="this.style.background='#f1f5f9'; this.style.color='#3b82f6';" onmouseout="this.style.background='transparent'; this.style.color='#64748b';">
                    @if(isset($breadcrumbMap[$segment]))
                        <span style="font-size: 16px;">{{ $breadcrumbMap[$segment]['icon'] }}</span>
                        <span>{{ $breadcrumbMap[$segment]['name'] }}</span>
                    @else
                        <span style="font-size: 16px;">📁</span>
                        <span>{{ ucfirst(str_replace('-', ' ', $segment)) }}</span>
                    @endif
                </a>
            @else
                <!-- Mevcut Sayfa -->
                <span style="display: flex; align-items: center; gap: 6px; color: #1e293b; font-size: 14px; font-weight: 600; padding: 6px 12px; background: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 100%); color: white; border-radius: 6px; box-shadow: 0 2px 8px rgba(59, 130, 246, 0.3);">
                    @if(isset($breadcrumbMap[$segment]))
                        <span style="font-size: 16px;">{{ $breadcrumbMap[$segment]['icon'] }}</span>
                        <span>{{ $breadcrumbMap[$segment]['name'] }}</span>
                    @else
                        <span style="font-size: 16px;">📁</span>
                        <span>{{ ucfirst(str_replace('-', ' ', $segment)) }}</span>
                    @endif
                </span>
            @endif
        @endforeach
    </div>
</nav>
@endif
<!-- Türkçe: Modern breadcrumb bileşeni, ikonlar, hover efektleri ve gradient tasarım ile --> 