@extends('layouts.app')

@section('content')
<!-- Modern CV Sayfası -->
<div style="max-width: 1200px; margin: 0 auto; padding: 24px 12px;">
    <!-- Yazdırma Butonu -->
    <div style="display: flex; justify-content: flex-end; margin-bottom: 32px;">
        <button onclick="window.print()" style="background: linear-gradient(135deg, #374151 0%, #1f2937 100%); color: white; border: none; padding: 12px 20px; border-radius: 8px; font-weight: 600; cursor: pointer; display: flex; align-items: center; gap: 8px; transition: all 0.3s ease; box-shadow: 0 4px 12px rgba(55, 65, 81, 0.3);" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 20px rgba(55, 65, 81, 0.4)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(55, 65, 81, 0.3)';">
            <span style="font-size: 16px;">🖨️</span>
            <span>PDF/Çıktı Al</span>
        </button>
    </div>

    <!-- Profil Başlık Bölümü -->
    <div style="text-align: center; margin-bottom: 32px;">
        <!-- Profil Bilgileri -->
        <div style="text-align: center;">
            <div style="background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%); border-radius: 16px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); padding: 32px; border: 1px solid #e2e8f0;">
                <!-- Profil Fotoğrafı -->
                <div style="position: relative; display: inline-block; margin-bottom: 24px;">
                    @if($user->profile && $user->profile->profile_image)
                        <img src="{{ asset('storage/' . $user->profile->profile_image) }}" style="width: 150px; height: 150px; border-radius: 50%; object-fit: cover; border: 4px solid #e2e8f0; box-shadow: 0 8px 20px rgba(0,0,0,0.1);" alt="{{ $user->name }}">
                    @else
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}" style="width: 150px; height: 150px; border-radius: 50%; object-fit: cover; border: 4px solid #e2e8f0; box-shadow: 0 8px 20px rgba(0,0,0,0.1);" alt="{{ $user->name }}">
                    @endif
                    <div style="position: absolute; bottom: 10px; right: 10px; width: 24px; height: 24px; background: linear-gradient(135deg, #10b981 0%, #059669 100%); border-radius: 50%; border: 3px solid white;"></div>
                </div>
                
                <!-- İsim ve Unvan -->
                <h1 style="font-size: 24px; font-weight: 700; color: #1e293b; margin-bottom: 8px;">{{ $user->name }}</h1>
                <p style="color: #64748b; font-size: clamp(14px, 3vw, 16px); margin: 0;">Profesyonel deneyimler, eğitim ve yetenekler</p>{{ $user->profile->title ?? 'Profesyonel' }}</p>
                
                <!-- Sosyal Medya Linkleri -->
                @if($user->profile && $user->profile->social_links)
                    <div style="display: flex; justify-content: center; gap: 12px; flex-wrap: wrap;">
                        @foreach($user->profile->social_links as $platform => $url)
                            @if($url)
                                <a href="{{ $url }}" target="_blank" style="width: 40px; height: 40px; background: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 100%); border-radius: 8px; display: flex; align-items: center; justify-content: center; color: white; text-decoration: none; transition: all 0.3s ease; box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 20px rgba(59, 130, 246, 0.4)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(59, 130, 246, 0.3)';">
                                    <span style="font-size: 16px;">🔗</span>
                                </a>
                            @endif
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Ana İçerik Grid -->
    <div style="display: grid; grid-template-columns: 1fr; gap: 24px;" class="cv-main-grid"> 
    @media (min-width: 768px) { 
        .cv-main-grid { grid-template-columns: 1fr 1fr !important; } 
    } margin-bottom: 48px;">
        <!-- Sol Kolon - İş Deneyimleri -->
        <div>
            <div style="background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%); border-radius: 16px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); padding: 32px; border: 1px solid #e2e8f0; height: fit-content;">
                <div style="display: flex; align-items: center; gap: 16px; margin-bottom: 32px;">
                    <div style="width: 48px; height: 48px; background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                        <span style="color: white; font-size: 20px;">💼</span>
                    </div>
                    <h1 style="font-size: clamp(24px, 5vw, 32px); font-weight: 700; color: #1e293b; margin: 0;">CV - Özgeçmiş</h1>
                </div>
                
                <div style="position: relative;">
                    @forelse($user->experiences as $exp)
                        <div style="position: relative; padding-left: 32px; margin-bottom: 32px; border-left: 2px solid #e2e8f0;">
                            <div style="position: absolute; left: -6px; top: 0; width: 12px; height: 12px; background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); border-radius: 50%; border: 2px solid white; box-shadow: 0 2px 8px rgba(245, 158, 11, 0.3);"></div>
                            <div style="margin-bottom: 16px;">
                                <h3 style="font-size: 18px; font-weight: 700; color: #1e293b; margin-bottom: 4px;">{{ $exp->position }}</h3>
                                <h4 style="font-size: 16px; font-weight: 600; color: #f59e0b; margin-bottom: 8px;">{{ $exp->company }}</h4>
                                <div style="font-size: 12px; color: #94a3b8; background: #f1f5f9; padding: 4px 8px; border-radius: 6px; display: inline-block; margin-bottom: 12px;">
                                    📅 {{ $exp->start_date->format('M Y') }} - {{ $exp->end_date ? $exp->end_date->format('M Y') : 'Devam Ediyor' }}
                                </div>
                                <p style="color: #64748b; font-size: 14px; line-height: 1.6; margin: 0;">{{ $exp->description }}</p>
                            </div>
                        </div>
                    @empty
                        <div style="text-align: center; color: #64748b; font-size: 16px; padding: 48px;">
                            <div style="font-size: 48px; margin-bottom: 16px;">💼</div>
                            <p style="margin: 0;">Henüz iş deneyimi eklenmemiş.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Profil Kartı -->
    <div style="background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%); border-radius: 16px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); padding: 24px; margin-bottom: 32px; border: 1px solid #e2e8f0;"> margin-bottom: 48px;">
        <div style="display: flex; align-items: center; gap: 16px; margin-bottom: 32px;">
            <div style="width: 48px; height: 48px; background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                <span style="color: white; font-size: 20px;">⚙️</span>
            </div>
            <h2 style="font-size: 24px; font-weight: 700; color: #1e293b; margin: 0;">Yetenekler</h2>
            
            <!-- Yetenekler Chart -->
            <div style="background: #f8fafc; border-radius: 12px; padding: 24px; border: 1px solid #e2e8f0;">
                <canvas id="skillChart" height="120" style="max-height: 300px;"></canvas>
            </div>
        
        <div style="background: #f8fafc; border-radius: 12px; padding: 24px; border: 1px solid #e2e8f0;">
            <canvas id="skillChart" height="120" style="max-height: 300px;"></canvas>
            <!-- Türkçe: Modern yetenekler chart'i -->
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.timeline {
    position: relative;
    margin-left: 1.5rem;
    padding-left: 1.5rem;
    border-left: 3px solid var(--color-primary, #2563eb);
}
.timeline-item {
    position: relative;
    padding-left: 1.5rem;
}
.timeline-dot {
    position: absolute;
    left: -1.7rem;
    top: 0.5rem;
    width: 1.1rem;
    height: 1.1rem;
    background: var(--color-primary, #2563eb);
    border-radius: 50%;
    border: 3px solid #fff;
    box-shadow: 0 0 0 2px var(--color-primary, #2563eb);
}
.timeline-content {
    background: var(--gray-50, #f8fafc);
    border-radius: 0.5rem;
    padding: 1rem 1.2rem;
    box-shadow: 0 2px 8px rgba(0,0,0,0.04);
}
.timeline-edu {
    border-color: var(--color-accent, #f59e0b);
}
.timeline-edu .timeline-dot {
    background: var(--color-accent, #f59e0b);
    box-shadow: 0 0 0 2px var(--color-accent, #f59e0b);
}
@media (max-width: 768px) {
    .timeline, .timeline-edu { margin-left: 0.5rem; padding-left: 0.5rem; }
    .timeline-content { padding: 0.7rem 0.5rem; }
}
.certificate-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    gap: 1rem;
}
.certificate-card {
    background: var(--gray-50, #f8fafc);
    border-radius: 0.7rem;
    box-shadow: 0 2px 8px rgba(0,0,0,0.06);
    padding: 1rem 1.2rem;
    position: relative;
    transition: box-shadow 0.2s, transform 0.2s;
    cursor: pointer;
    min-height: 120px;
}
.certificate-card:hover {
    box-shadow: 0 8px 32px rgba(37,99,235,0.13);
    transform: translateY(-4px) scale(1.03);
}
.certificate-title {
    font-weight: 700;
    color: var(--color-primary, #2563eb);
    margin-bottom: 0.2rem;
}
.certificate-org {
    font-size: 0.98em;
    color: var(--gray-600, #64748b);
}
.certificate-link {
    display: inline-block;
    margin-top: 0.3rem;
    color: var(--color-accent, #f59e0b);
    font-size: 0.95em;
    text-decoration: underline;
}
.certificate-hover {
    display: none;
    position: absolute;
    left: 0; right: 0; bottom: 0; top: 0;
    background: rgba(255,255,255,0.97);
    border-radius: 0.7rem;
    padding: 1rem;
    font-size: 0.98em;
    color: var(--gray-700, #334155);
    z-index: 2;
    box-shadow: 0 2px 12px rgba(0,0,0,0.08);
}
.certificate-card:hover .certificate-hover {
    display: block;
}
@media print {
    body * { visibility: hidden !important; }
    .container, .container * { visibility: visible !important; }
    .container { position: absolute; left: 0; top: 0; width: 100%; background: #fff; }
    .btn, .d-print-none, nav, footer { display: none !important; }
    .card, .timeline-content, .certificate-card { box-shadow: none !important; border: 1px solid #ddd !important; }
}
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var ctx = document.getElementById('skillChart');
    if(ctx) {
        var chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [
                    @foreach($user->skills as $skill)
                        '{{ $skill->name }}',
                    @endforeach
                ],
                datasets: [{
                    label: 'Yetenek Seviyesi',
                    data: [
                        @foreach($user->skills as $skill)
                            {{ $skill->pivot->level ?? 50 }},
                        @endforeach
                    ],
                    backgroundColor: 'rgba(37,99,235,0.7)',
                    borderRadius: 8,
                }]
            },
            options: {
                indexAxis: 'y',
                scales: {
                    x: { min: 0, max: 100, title: { display: true, text: 'Seviye (%)' } },
                    y: { title: { display: false } }
                },
                plugins: {
                    legend: { display: false },
                    tooltip: { enabled: true }
                }
            }
        });
    }
});
// Türkçe: Yetenekler Chart.js ile bar chart olarak gösteriliyor.
</script>
@endpush

{{-- Türkçe yorum: Bu sayfa, kullanıcının tüm CV verilerini modern ve kart tabanlı bir şekilde kamuya açık olarak gösterir. --}} 