@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Blog Yazısı Düzenle</h2>
    <form action="{{ route('posts.update', $post) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Başlık</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $post->title) }}" required maxlength="255">
        </div>
        <div class="mb-3">
            <label for="blog_category_id" class="form-label">Kategori</label>
            <select class="form-select" id="blog_category_id" name="blog_category_id" required>
                <option value="">Seçiniz</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" @if($post->blog_category_id == $cat->id) selected @endif>{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Mevcut Kapak Görseli</label><br>
            @if($post->image)
                <img src="{{ asset('storage/' . $post->image) }}" alt="Kapak Görseli" style="width: 100px; height: 100px; object-fit: cover;">
            @else
                <em>Görsel yok</em>
            @endif
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Yeni Kapak Görseli (isteğe bağlı)</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*">
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">İçerik</label>
            <textarea class="form-control" id="content" name="content" rows="10" required>{{ old('content', $post->content) }}</textarea>
        </div>
        <button type="submit" class="btn btn-success">Güncelle</button>
        <a href="{{ route('posts.index') }}" class="btn btn-secondary">İptal</a>
    </form>
</div>
@endsection

@push('scripts')
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    // Türkçe yorum: İçerik alanı için TinyMCE editörü ekleniyor.
    tinymce.init({
        selector: 'textarea#content',
        plugins: 'image media link code',
        toolbar: 'undo redo | bold italic | alignleft aligncenter alignright | bullist numlist | link image | code',
        menubar: false,
        language: 'tr',
        paste_data_images: false,
        relative_urls: false
    });
</script>
@endpush

{{-- Türkçe yorum: Bu form, mevcut bir blog yazısını düzenlemek için kullanılır. --}} 