@extends('layouts.admin')
@section('content')
<div class="container mx-auto py-6">
    <h1 class="text-2xl font-bold mb-4">Galeri Öğesini Düzenle</h1>
    <form action="{{ route('admin.gallery.update', $gallery) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow max-w-lg">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Başlık</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ $gallery->title }}" required>
            @error('title')<div class="text-red-500 text-sm">{{ $message }}</div>@enderror
            <!-- Türkçe: Galeri başlığı alanı -->
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Açıklama</label>
            <textarea name="description" id="description" class="form-control">{{ $gallery->description }}</textarea>
            @error('description')<div class="text-red-500 text-sm">{{ $message }}</div>@enderror
            <!-- Türkçe: Galeri açıklama alanı -->
        </div>
        <div class="mb-3">
            <label for="file" class="form-label">Dosya (Resim veya Video)</label>
            <input type="file" name="file" id="file" class="form-control">
            @if($gallery->type === 'image')
                <img src="{{ asset('storage/' . $gallery->path) }}" alt="{{ $gallery->alt_text ?? $gallery->title }}" width="120" class="mt-2 rounded">
            @else
                <video width="120" controls class="mt-2 rounded">
                    <source src="{{ asset('storage/' . $gallery->path) }}" type="video/mp4">
                </video>
            @endif
            @error('file')<div class="text-red-500 text-sm">{{ $message }}</div>@enderror
            <!-- Türkçe: Mevcut dosya önizlemesi ve yeni dosya yükleme alanı -->
        </div>
        <div class="mb-3">
            <label for="alt_text" class="form-label">Alt Text (SEO)</label>
            <input type="text" name="alt_text" id="alt_text" class="form-control" value="{{ $gallery->alt_text }}">
            @error('alt_text')<div class="text-red-500 text-sm">{{ $message }}</div>@enderror
            <!-- Türkçe: Görsel için SEO ve erişilebilirlik alt metni alanı -->
        </div>
        <div class="mb-3">
            <label for="type" class="form-label">Tür</label>
            <select name="type" id="type" class="form-control" required>
                <option value="image" @if($gallery->type==='image') selected @endif>Görsel</option>
                <option value="video" @if($gallery->type==='video') selected @endif>Video</option>
            </select>
            @error('type')<div class="text-red-500 text-sm">{{ $message }}</div>@enderror
            <!-- Türkçe: Görsel veya video türü seçimi -->
        </div>
        <div class="mb-3">
            <label for="order" class="form-label">Sıra</label>
            <input type="number" name="order" id="order" class="form-control" value="{{ $gallery->order }}">
            @error('order')<div class="text-red-500 text-sm">{{ $message }}</div>@enderror
            <!-- Türkçe: Sıralama için order alanı -->
        </div>
        <button type="submit" class="btn btn-success">Güncelle</button>
        <a href="{{ route('admin.gallery.index') }}" class="btn btn-secondary ml-2">İptal</a>
    </form>
</div>
@endsection 