@extends('layouts.admin')
@section('title', 'Yeni Blog Yazısı')
@section('content')
<div class="container py-4" style="max-width: 700px;">
    <h2 class="fw-bold mb-4">Yeni Blog Yazısı Ekle</h2>
    <form action="{{ route('admin.blog.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-4 rounded shadow-sm border">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Başlık</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required maxlength="255" placeholder="Yazı başlığı giriniz">
        </div>
        <div class="mb-3">
            <label for="blog_category_id" class="form-label">Kategori</label>
            <select name="blog_category_id" id="blog_category_id" class="form-select" required>
                <option value="">Seçiniz</option>
                @foreach(\App\Models\BlogCategory::all() as $cat)
                    <option value="{{ $cat->id }}" {{ old('blog_category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Durum</label>
            <select name="status" id="status" class="form-select" required>
                <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Taslak</option>
                <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Yayınla</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="published_at" class="form-label">Yayın Tarihi</label>
            <input type="datetime-local" name="published_at" id="published_at" class="form-control" value="{{ old('published_at', now()->format('Y-m-d\TH:i')) }}">
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Kapak Görseli</label>
            <input type="file" name="image" id="image" class="form-control" accept="image/*">
            <div class="form-text">JPEG, PNG, GIF, SVG veya WebP formatında, maksimum 4MB.</div>
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">İçerik</label>
            <textarea name="content" id="content" class="form-control" rows="10" required placeholder="Yazı içeriğini giriniz">{{ old('content') }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary rounded-pill px-4">Kaydet</button>
        <a href="{{ route('admin.blog.index') }}" class="btn btn-secondary rounded-pill px-4 ms-2">İptal</a>
    </form>
</div>
<!-- Türkçe yorum: Admin paneli blog ekleme formu modern, Bootstrap tabanlı ve kullanıcı dostu şekilde güncellendi. -->
@endsection 