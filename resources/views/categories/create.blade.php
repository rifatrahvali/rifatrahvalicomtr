@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Yeni Kategori Ekle</h2>
    <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Kategori Adı</label>
            <input type="text" class="form-control" id="name" name="name" required maxlength="150">
        </div>
        <div class="mb-3">
            <label for="parent_id" class="form-label">Üst Kategori (isteğe bağlı)</label>
            <select class="form-select" id="parent_id" name="parent_id">
                <option value="">Yok (Ana Kategori)</option>
                @foreach($parents as $parent)
                    <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Kategori Görseli (isteğe bağlı)</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*">
        </div>
        <button type="submit" class="btn btn-success">Kaydet</button>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary">İptal</a>
    </form>
</div>
@endsection

{{-- Türkçe yorum: Bu form, yeni bir kategori eklemek için kullanılır. --}} 