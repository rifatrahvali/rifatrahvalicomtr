@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Kategori Düzenle</h2>
    <form action="{{ route('categories.update', $category) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Kategori Adı</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $category->name) }}" required maxlength="150">
        </div>
        <div class="mb-3">
            <label for="parent_id" class="form-label">Üst Kategori (isteğe bağlı)</label>
            <select class="form-select" id="parent_id" name="parent_id">
                <option value="">Yok (Ana Kategori)</option>
                @foreach($parents as $parent)
                    <option value="{{ $parent->id }}" @if($category->parent_id == $parent->id) selected @endif>{{ $parent->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Mevcut Görsel</label><br>
            @if($category->image)
                <img src="{{ asset('storage/' . $category->image) }}" alt="Kategori Görseli" style="width: 100px; height: 100px; object-fit: cover;">
            @else
                <em>Görsel yok</em>
            @endif
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Yeni Görsel Yükle (isteğe bağlı)</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*">
        </div>
        <button type="submit" class="btn btn-success">Güncelle</button>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary">İptal</a>
    </form>
</div>
@endsection

{{-- Türkçe yorum: Bu form, mevcut bir kategoriyi düzenlemek için kullanılır. --}} 