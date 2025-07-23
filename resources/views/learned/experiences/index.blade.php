@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>İş Deneyimlerinden Kazanımlar</h2>
        <a href="{{ route('learned.experiences.create') }}" class="btn btn-primary">Yeni Kazanım Ekle</a>
    </div>
    @foreach($experiences as $experience)
        <div class="card mb-3">
            <div class="card-header">
                <strong>{{ $experience->title }}</strong> - {{ $experience->company }}
            </div>
            <div class="card-body">
                @if($experience->learnedExperiences && count($experience->learnedExperiences))
                    <ul>
                        @foreach($experience->learnedExperiences as $learned)
                            <li>
                                <strong>{{ $learned->activity_field }}</strong>: {{ $learned->description }}
                                @if($learned->activity_tags)
                                    <span class="badge bg-info">{{ implode(', ', $learned->activity_tags) }}</span>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                @else
                    <em>Bu deneyimden henüz kazanım eklenmemiş.</em>
                @endif
            </div>
        </div>
    @endforeach
</div>
@endsection

{{-- Türkçe yorum: Bu sayfa, kullanıcının iş deneyimlerinden elde ettiği kazanımları listeler. --}} 