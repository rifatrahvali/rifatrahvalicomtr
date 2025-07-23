@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Toplu Galeri Yükleme</h1>
    <form action="{{ route('admin.gallery.bulk-upload') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="files" class="form-label">Dosyalar (Birden fazla seçebilirsiniz)</label>
            <input type="file" name="files[]" id="files" class="form-control" multiple required>
            <!-- Türkçe yorum: Çoklu dosya yükleme alanı -->
        </div>
        <button type="submit" class="btn btn-success">Yükle</button>
        <a href="{{ route('admin.gallery.index') }}" class="btn btn-secondary">İptal</a>
    </form>
</div>
@endsection 