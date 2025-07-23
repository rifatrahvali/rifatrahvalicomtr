@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Referans Düzenle</h1>
    <form action="{{ route('admin.reference.update', $reference) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Ad</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $reference->name }}" required>
            <!-- Türkçe yorum: Referans adı alanı -->
        </div>
        <div class="mb-3">
            <label for="company_name" class="form-label">Şirket</label>
            <input type="text" name="company_name" id="company_name" class="form-control" value="{{ $reference->company_name }}">
            <!-- Türkçe yorum: Şirket adı alanı -->
        </div>
        <div class="mb-3">
            <label for="position" class="form-label">Pozisyon</label>
            <input type="text" name="position" id="position" class="form-control" value="{{ $reference->position }}">
            <!-- Türkçe yorum: Pozisyon alanı -->
        </div>
        <div class="mb-3">
            <label for="images" class="form-label">Görseller (Eklemek için seçin)</label>
            <input type="file" name="images[]" id="images" class="form-control" multiple>
            <!-- Türkçe yorum: Çoklu görsel yükleme alanı -->
            <div class="mt-2">
                @foreach($reference->images as $img)
                    <img src="{{ asset('storage/' . $img) }}" alt="{{ $reference->name }}" width="60" class="me-1 mb-1">
                @endforeach
                <!-- Türkçe yorum: Mevcut görsellerin önizlemesi -->
            </div>
        </div>
        <div class="mb-3">
            <label for="website_url" class="form-label">Web Sitesi</label>
            <input type="url" name="website_url" id="website_url" class="form-control" value="{{ $reference->website_url }}">
            <!-- Türkçe yorum: Website alanı -->
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Açıklama</label>
            <textarea name="description" id="description" class="form-control">{{ $reference->description }}</textarea>
            <!-- Türkçe yorum: Açıklama alanı -->
        </div>
        <div class="mb-3">
            <label for="order_index" class="form-label">Sıra</label>
            <input type="number" name="order_index" id="order_index" class="form-control" value="{{ $reference->order_index }}">
            <!-- Türkçe yorum: Sıralama alanı -->
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" name="is_active" id="is_active" class="form-check-input" {{ $reference->is_active ? 'checked' : '' }}>
            <label for="is_active" class="form-check-label">Aktif</label>
            <!-- Türkçe yorum: Aktiflik durumu -->
        </div>
        <button type="submit" class="btn btn-success">Güncelle</button>
        <a href="{{ route('admin.reference.index') }}" class="btn btn-secondary">İptal</a>
    </form>
</div>
@endsection 