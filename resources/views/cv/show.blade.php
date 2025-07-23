@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-end mb-3">
        <button onclick="window.print()" class="btn btn-outline-dark d-print-none"><i class="bi bi-printer"></i> PDF/Çıktı Al</button>
    </div>
    <div class="row mb-4">
        <div class="col-md-3 text-center">
            @if($user->profile && $user->profile->profile_image)
                <img src="{{ asset('storage/' . $user->profile->profile_image) }}" class="img-thumbnail rounded-circle mb-2" style="width: 150px; height: 150px; object-fit: cover;">
            @else
                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}" class="img-thumbnail rounded-circle mb-2" style="width: 150px; height: 150px; object-fit: cover;">
            @endif
            <h3>{{ $user->name }}</h3>
            <p class="text-muted">{{ $user->profile->title ?? '' }}</p>
            <div>
                @if($user->profile && $user->profile->social_links)
                    @foreach($user->profile->social_links as $platform => $url)
                        @if($url)
                            <a href="{{ $url }}" target="_blank" class="me-2"><i class="bi bi-{{ $platform }}"></i></a>
                        @endif
                    @endforeach
                @endif
            </div>
        </div>
        <div class="col-md-9">
            <div class="card mb-3">
                <div class="card-header">Hakkımda</div>
                <div class="card-body">
                    {!! $user->about->description ?? '<em>Henüz bilgi girilmemiş.</em>' !!}
                </div>
            </div>
            <div class="mb-2">
                @if($user->about && $user->about->cv_url)
                    <a href="{{ asset('storage/' . $user->about->cv_url) }}" class="btn btn-outline-primary btn-sm" target="_blank">CV'yi İndir</a>
                @endif
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header">İş Deneyimleri</div>
                <div class="card-body">
                    <div class="timeline">
                    @forelse($user->experiences as $exp)
                        <div class="timeline-item mb-4">
                            <div class="timeline-dot"></div>
                            <div class="timeline-content">
                                <strong>{{ $exp->title }}</strong> - {{ $exp->company }}<br>
                                <small class="text-muted">{{ $exp->start_date }} - {{ $exp->end_date ?? 'Devam ediyor' }}</small>
                                <div>{{ $exp->description }}</div>
                                @if($exp->learnedExperiences && count($exp->learnedExperiences))
                                    <ul class="mt-1">
                                        @foreach($exp->learnedExperiences as $learned)
                                            <li>{{ $learned->description }} @if($learned->activity_tags) <span class="badge bg-info">{{ implode(', ', $learned->activity_tags) }}</span> @endif</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>
                    @empty
                        <em>Deneyim eklenmemiş.</em>
                    @endforelse
                    </div>
                    <!-- Türkçe: İş deneyimleri timeline olarak gösteriliyor. -->
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header">Eğitimler</div>
                <div class="card-body">
                    <div class="timeline timeline-edu">
                    @forelse($user->educations as $edu)
                        <div class="timeline-item mb-4">
                            <div class="timeline-dot"></div>
                            <div class="timeline-content">
                                <strong>{{ $edu->school }}</strong> - {{ $edu->degree }}<br>
                                <small class="text-muted">{{ $edu->start_date }} - {{ $edu->end_date ?? 'Devam ediyor' }}</small>
                                <div>{{ $edu->description }}</div>
                                @if($edu->learnedEducations && count($edu->learnedEducations))
                                    <ul class="mt-1">
                                        @foreach($edu->learnedEducations as $learned)
                                            <li>
                                                <strong>Temel:</strong> {{ $learned->core_learnings ? implode(', ', $learned->core_learnings) : '-' }}<br>
                                                <strong>Genel:</strong> {{ $learned->general_learnings ? implode(', ', $learned->general_learnings) : '-' }}
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>
                    @empty
                        <em>Eğitim eklenmemiş.</em>
                    @endforelse
                    </div>
                    <!-- Türkçe: Eğitimler timeline olarak gösteriliyor. -->
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header">Sertifikalar</div>
                <div class="card-body">
                    <div class="certificate-grid">
                    @forelse($user->certificates as $cert)
                        <div class="certificate-card">
                            <div class="certificate-title">{{ $cert->name }}</div>
                            <div class="certificate-org">{{ $cert->issuing_organization }}</div>
                            <div class="certificate-date text-muted small">{{ $cert->issue_date }}</div>
                            @if($cert->credential_url)
                                <a href="{{ $cert->credential_url }}" target="_blank" class="certificate-link">Doğrula</a>
                            @endif
                            <div class="certificate-hover">
                                {{ $cert->description }}
                            </div>
                        </div>
                    @empty
                        <em>Sertifika eklenmemiş.</em>
                    @endforelse
                    </div>
                    <!-- Türkçe: Sertifikalar grid ve hover ile detay gösterimi şeklinde listeleniyor. -->
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header">Kurslar</div>
                <div class="card-body">
                    @forelse($user->courses as $course)
                        <div class="mb-2">
                            <strong>{{ $course->name }}</strong> - {{ $course->organization }}<br>
                            <small class="text-muted">{{ $course->completion_date }}</small>
                            @if($course->credential_url)
                                <a href="{{ $course->credential_url }}" target="_blank">Kurs Linki</a>
                            @endif
                        </div>
                    @empty
                        <em>Kurs eklenmemiş.</em>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card h-100">
                <div class="card-header">Yetenekler</div>
                <div class="card-body">
                    <canvas id="skillChart" height="120"></canvas>
                    <!-- Türkçe: Yetenekler bar chart olarak görselleştiriliyor. -->
                </div>
            </div>
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