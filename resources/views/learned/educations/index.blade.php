@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Eğitimlerden Kazanımlar</h2>
        <a href="{{ route('learned.educations.create') }}" class="btn btn-primary">Yeni Kazanım Ekle</a>
    </div>
    @foreach($educations as $education)
        <div class="card mb-3">
            <div class="card-header">
                <strong>{{ $education->school }}</strong> - {{ $education->degree }}
            </div>
            <div class="card-body">
                @if($education->learnedEducations && count($education->learnedEducations))
                    <ul>
                        @foreach($education->learnedEducations as $learned)
                            <li>
                                <strong>Temel Kazanımlar:</strong> {{ $learned->core_learnings ? implode(', ', $learned->core_learnings) : '-' }}<br>
                                <strong>Genel Kazanımlar:</strong> {{ $learned->general_learnings ? implode(', ', $learned->general_learnings) : '-' }}
                            </li>
                        @endforeach
                    </ul>
                @else
                    <em>Bu eğitimden henüz kazanım eklenmemiş.</em>
                @endif
            </div>
        </div>
    @endforeach
</div>
@endsection

{{-- Türkçe yorum: Bu sayfa, kullanıcının eğitimlerinden elde ettiği kazanımları listeler. --}} 