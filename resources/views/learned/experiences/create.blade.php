@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Yeni İş Deneyimi Kazanımı Ekle</h2>
    <form action="{{ route('learned.experiences.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="experience_id" class="form-label">Deneyim</label>
            <select class="form-select" id="experience_id" name="experience_id" required>
                <option value="">Seçiniz</option>
                @foreach($experiences as $exp)
                    <option value="{{ $exp->id }}">{{ $exp->title }} - {{ $exp->company }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Kazanım Açıklaması</label>
            <input type="text" class="form-control" id="description" name="description" maxlength="500" required>
        </div>
        <div class="mb-3">
            <label for="activity_field" class="form-label">Alan (isteğe bağlı)</label>
            <input type="text" class="form-control" id="activity_field" name="activity_field" maxlength="150">
        </div>
        <div class="mb-3">
            <label for="activity_tags" class="form-label">Etiketler (virgülle ayırınız)</label>
            <input type="text" class="form-control" id="activity_tags" name="activity_tags">
        </div>
        <button type="submit" class="btn btn-success">Kaydet</button>
        <a href="{{ route('learned.experiences.index') }}" class="btn btn-secondary">İptal</a>
    </form>
</div>
@endsection

{{-- Türkçe yorum: Bu form, yeni bir iş deneyimi kazanımı eklemek için kullanılır. --}} 