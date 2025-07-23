@extends('layouts.app')

@section('content')
<div class="container py-4">
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
                    @forelse($user->experiences as $exp)
                        <div class="mb-3">
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
                    @empty
                        <em>Deneyim eklenmemiş.</em>
                    @endforelse
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header">Eğitimler</div>
                <div class="card-body">
                    @forelse($user->educations as $edu)
                        <div class="mb-3">
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
                    @empty
                        <em>Eğitim eklenmemiş.</em>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header">Sertifikalar</div>
                <div class="card-body">
                    @forelse($user->certificates as $cert)
                        <div class="mb-2">
                            <strong>{{ $cert->name }}</strong> - {{ $cert->issuing_organization }}<br>
                            <small class="text-muted">{{ $cert->issue_date }}</small>
                            @if($cert->credential_url)
                                <a href="{{ $cert->credential_url }}" target="_blank">Doğrula</a>
                            @endif
                        </div>
                    @empty
                        <em>Sertifika eklenmemiş.</em>
                    @endforelse
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
</div>
@endsection

{{-- Türkçe yorum: Bu sayfa, kullanıcının tüm CV verilerini modern ve kart tabanlı bir şekilde kamuya açık olarak gösterir. --}} 