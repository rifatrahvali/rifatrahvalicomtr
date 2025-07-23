@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Galeri Yönetimi</h1>
    <a href="{{ route('admin.gallery.create') }}" class="btn btn-primary mb-3">Yeni Galeri Öğesi Ekle</a>
    <a href="{{ route('admin.gallery.bulk-upload-form') }}" class="btn btn-secondary mb-3">Toplu Yükleme</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Sıra</th>
                <th>Başlık</th>
                <th>Tür</th>
                <th>Önizleme</th>
                <th>Açıklama</th>
                <th>İşlemler</th>
            </tr>
        </thead>
        <tbody>
            @foreach($galleries as $gallery)
            <tr>
                <td>{{ $gallery->order }}</td>
                <td>{{ $gallery->title }}</td>
                <td>{{ $gallery->type }}</td>
                <td>
                    @if($gallery->type === 'image')
                        <img src="{{ asset('storage/' . $gallery->path) }}" alt="{{ $gallery->title }}" width="80">
                    @else
                        <video width="80" controls>
                            <source src="{{ asset('storage/' . $gallery->path) }}" type="video/mp4">
                        </video>
                    @endif
                    <!-- Türkçe yorum: Görsel veya video önizlemesi -->
                </td>
                <td>{{ $gallery->description }}</td>
                <td>
                    <a href="{{ route('admin.gallery.edit', $gallery) }}" class="btn btn-sm btn-warning">Düzenle</a>
                    <form action="{{ route('admin.gallery.destroy', $gallery) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Silmek istediğinize emin misiniz?')">Sil</button>
                    </form>
                    <!-- Türkçe yorum: Düzenle ve sil butonları -->
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $galleries->links() }}
    <!-- Türkçe yorum: Sayfalama linkleri -->
</div>
@endsection 