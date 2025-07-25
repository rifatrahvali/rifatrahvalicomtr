@extends('layouts.admin')
@section('content')
<div class="container mx-auto py-6">
    <h1 class="text-2xl font-bold mb-4">Toplu Galeri Yükleme</h1>
    @if(session('success'))
        <div class="alert alert-success mb-4">{{ session('success') }}</div>
        <!-- Türkçe: Başarı mesajı -->
    @endif
    <form action="{{ route('admin.gallery.bulk-upload.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow max-w-lg">
        @csrf
        <div class="mb-3">
            <label for="files" class="form-label">Dosyalar (Birden fazla seçebilirsiniz)</label>
            <input type="file" name="files[]" id="files" class="form-control" multiple required>
            <!-- Türkçe: Çoklu dosya yükleme alanı -->
        </div>
        <button type="submit" class="btn btn-success">Yükle</button>
        <a href="{{ route('admin.gallery.index') }}" class="btn btn-secondary ml-2">İptal</a>
    </form>
</div>
@endsection 