@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Hakkımda Bölümleri</h2>
        <a href="{{ route('abouts.create') }}" class="btn btn-primary">Yeni Bölüm Ekle</a>
    </div>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered" id="about-table">
        <thead>
            <tr>
                <th>Sıra</th>
                <th>Başlık</th>
                <th>Açıklama</th>
                <th>Aktif</th>
                <th>İşlemler</th>
            </tr>
        </thead>
        <tbody id="sortable">
            @foreach($abouts as $about)
                <tr data-id="{{ $about->id }}">
                    <td>{{ $about->order }}</td>
                    <td>{{ $about->title }}</td>
                    <td>{{ Str::limit($about->description, 50) }}</td>
                    <td>
                        @if($about->is_active)
                            <span class="badge bg-success">Aktif</span>
                        @else
                            <span class="badge bg-secondary">Pasif</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('abouts.edit', $about) }}" class="btn btn-sm btn-warning">Düzenle</a>
                        <form action="{{ route('abouts.destroy', $about) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Silmek istediğinize emin misiniz?')">Sil</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{-- Türkçe yorum: Sıralama için drag&drop özelliği eklenebilir. --}}
</div>
@endsection

@push('scripts')
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    // Türkçe yorum: Açıklama alanı için TinyMCE editörü ekleniyor.
    tinymce.init({
        selector: 'textarea#description',
        plugins: 'lists link image code',
        toolbar: 'undo redo | bold italic | alignleft aligncenter alignright | bullist numlist | link image | code',
        menubar: false,
        language: 'tr',
    });
</script>
@endpush

{{-- Türkçe yorum: Bu sayfa, kullanıcının hakkımda bölümlerini listeler ve sıralama/düzenleme/silme işlemlerini sağlar. --}} 