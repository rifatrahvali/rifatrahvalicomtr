@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Yeni Eğitim Kazanımı Ekle</h2>
    <form action="{{ route('learned.educations.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="education_id" class="form-label">Eğitim</label>
            <select class="form-select" id="education_id" name="education_id" required>
                <option value="">Seçiniz</option>
                @foreach($educations as $edu)
                    <option value="{{ $edu->id }}">{{ $edu->school }} - {{ $edu->degree }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="core_learnings" class="form-label">Temel Kazanımlar (virgülle ayırınız)</label>
            <input type="text" class="form-control" id="core_learnings" name="core_learnings">
        </div>
        <div class="mb-3">
            <label for="general_learnings" class="form-label">Genel Kazanımlar (virgülle ayırınız)</label>
            <input type="text" class="form-control" id="general_learnings" name="general_learnings">
        </div>
        <button type="submit" class="btn btn-success">Kaydet</button>
        <a href="{{ route('learned.educations.index') }}" class="btn btn-secondary">İptal</a>
    </form>
</div>
@endsection

{{-- Türkçe yorum: Bu form, yeni bir eğitim kazanımı eklemek için kullanılır. --}} 