@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Yeni Blog Yazısı Ekle</h2>
    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Başlık</label>
            <input type="text" class="form-control" id="title" name="title" required maxlength="255">
        </div>
        <div class="mb-3">
            <label for="blog_category_id" class="form-label">Kategori</label>
            <select class="form-select" id="blog_category_id" name="blog_category_id" required>
                <option value="">Seçiniz</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Kapak Görseli (isteğe bağlı)</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*">
        </div>
        <div class="mb-3">
            <label for="tags" class="form-label">Etiketler (virgülle ayırın veya seçin)</label>
            <select class="form-select" id="tags" name="tags[]" multiple>
                @foreach($allTags as $tag)
                    <option value="{{ $tag->name }}">{{ $tag->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">İçerik</label>
            <textarea class="form-control" id="content" name="content" rows="10" required></textarea>
        </div>
        <button type="submit" class="btn btn-success">Kaydet</button>
        <a href="{{ route('posts.index') }}" class="btn btn-secondary">İptal</a>
    </form>
</div>
@endsection

@push('scripts')
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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

    // Türkçe yorum: Etiket alanı için Select2 çoklu seçim eklendi.
    $(document).ready(function() {
        $('#tags').select2({
            tags: true,
            tokenSeparators: [','],
            placeholder: 'Etiket ekle',
            width: '100%'
        });
    });
</script>
@endpush

{{-- Türkçe yorum: Bu form, yeni bir blog yazısı eklemek için kullanılır. --}} 