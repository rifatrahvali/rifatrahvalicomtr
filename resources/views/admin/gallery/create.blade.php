@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Yeni Galeri Öğesi Ekle</h1>
    <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Başlık</label>
            <input type="text" name="title" id="title" class="form-control" required>
            <!-- Türkçe yorum: Galeri başlığı alanı -->
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Açıklama</label>
            <textarea name="description" id="description" class="form-control"></textarea>
            <!-- Türkçe yorum: Galeri açıklama alanı -->
        </div>
        <div class="mb-3">
            <label for="file" class="form-label">Dosya (Resim veya Video)</label>
            <input type="file" name="file" id="file" class="form-control" required>
            <!-- Türkçe yorum: Dosya yükleme alanı -->
        </div>
        <div class="mb-3">
            <label for="type" class="form-label">Tür</label>
            <select name="type" id="type" class="form-control" required>
                <option value="image">Görsel</option>
                <option value="video">Video</option>
            </select>
            <!-- Türkçe yorum: Görsel veya video türü seçimi -->
        </div>
        <div class="mb-3">
            <label for="alt_text" class="form-label">Alt Text (SEO)</label>
            <input type="text" name="alt_text" id="alt_text" class="form-control">
            <!-- Türkçe yorum: Görsel için SEO ve erişilebilirlik alt metni alanı -->
        </div>
        <div class="mb-3">
            <label for="order" class="form-label">Sıra</label>
            <input type="number" name="order" id="order" class="form-control" value="0">
            <!-- Türkçe yorum: Sıralama için order alanı -->
        </div>
        <button type="submit" class="btn btn-success">Kaydet</button>
        <a href="{{ route('admin.gallery.index') }}" class="btn btn-secondary">İptal</a>
    </form>
</div>
@endsection 