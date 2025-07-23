@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Hakkımda Bölümünü Düzenle</h2>
    <form action="{{ route('abouts.update', $about) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Başlık</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $about->title) }}" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Açıklama</label>
            <textarea class="form-control" id="description" name="description" rows="5" required>{{ old('description', $about->description) }}</textarea>
        </div>
        <div class="mb-3">
            <label for="order" class="form-label">Sıra</label>
            <input type="number" class="form-control" id="order" name="order" value="{{ old('order', $about->order) }}">
        </div>
        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" {{ $about->is_active ? 'checked' : '' }}>
            <label class="form-check-label" for="is_active">Aktif</label>
        </div>
        <button type="submit" class="btn btn-success">Güncelle</button>
        <a href="{{ route('abouts.index') }}" class="btn btn-secondary">İptal</a>
    </form>
</div>
@endsection

@push('scripts')
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    // Türkçe yorum: Açıklama alanı için TinyMCE editörü ekleniyor.
    tinymce.init({
        selector: 'textarea#description',
        plugins: 'lists link image code',
        toolbar: 'undo redo | bold italic | alignleft aligncenter alignright | bullist numlist | link image | code',
        menubar: false,
        language: 'tr',
    });
</script>
@endpush

{{-- Türkçe yorum: Bu form, mevcut bir hakkımda bölümünü düzenlemek için kullanılır. --}} 