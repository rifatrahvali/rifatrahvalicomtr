@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Yeni Referans Ekle</h1>
    <form action="{{ route('admin.reference.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Ad</label>
            <input type="text" name="name" id="name" class="form-control" required>
            <!-- Türkçe yorum: Referans adı alanı -->
        </div>
        <div class="mb-3">
            <label for="company_name" class="form-label">Şirket</label>
            <input type="text" name="company_name" id="company_name" class="form-control">
            <!-- Türkçe yorum: Şirket adı alanı -->
        </div>
        <div class="mb-3">
            <label for="position" class="form-label">Pozisyon</label>
            <input type="text" name="position" id="position" class="form-control">
            <!-- Türkçe yorum: Pozisyon alanı -->
        </div>
        <div class="mb-3">
            <label for="images" class="form-label">Görseller (Çoklu Seçim)</label>
            <input type="file" name="images[]" id="images" class="form-control" multiple required>
            <!-- Türkçe yorum: Çoklu görsel yükleme alanı -->
        </div>
        <div class="mb-3">
            <label for="website_url" class="form-label">Web Sitesi</label>
            <input type="url" name="website_url" id="website_url" class="form-control">
            <!-- Türkçe yorum: Website alanı -->
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Açıklama</label>
            <textarea name="description" id="description" class="form-control"></textarea>
            <!-- Türkçe yorum: Açıklama alanı -->
        </div>
        <div class="mb-3">
            <label for="order_index" class="form-label">Sıra</label>
            <input type="number" name="order_index" id="order_index" class="form-control" value="0">
            <!-- Türkçe yorum: Sıralama alanı -->
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" name="is_active" id="is_active" class="form-check-input" checked>
            <label for="is_active" class="form-check-label">Aktif</label>
            <!-- Türkçe yorum: Aktiflik durumu -->
        </div>
        <button type="submit" class="btn btn-success">Kaydet</button>
        <a href="{{ route('admin.reference.index') }}" class="btn btn-secondary">İptal</a>
    </form>
</div>
@endsection 