@extends('layouts.admin')
@section('title', 'Blog Yazıları')
@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">Blog Yazıları</h2>
        <a href="{{ route('admin.blog.create') }}" class="btn btn-success rounded-pill px-4">+ Yeni Blog Yazısı</a>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle border rounded shadow-sm">
            <thead class="table-light">
                <tr>
                    <th>Görsel</th>
                    <th>Başlık</th>
                    <th>Kategori</th>
                    <th>Yazar</th>
                    <th>Durum</th>
                    <th>Yayın Tarihi</th>
                    <th style="width: 180px;">İşlemler</th>
                </tr>
            </thead>
            <tbody>
                @foreach($posts as $post)
                    <tr>
                        <td>
                            @if($post->image)
                                <img src="{{ asset('storage/' . $post->image) }}" alt="Görsel" style="width: 60px; height: 40px; object-fit: cover; border-radius: 6px;">
                            @else
                                <img src="/images/placeholder-blog.jpg" alt="Placeholder" style="width: 60px; height: 40px; object-fit: cover; border-radius: 6px;">
                            @endif
                        </td>
                        <td class="fw-semibold">{{ $post->title }}</td>
                        <td>{{ $post->category->name ?? '-' }}</td>
                        <td>{{ $post->user->name ?? '-' }}</td>
                        <td>
                            @if($post->status === 'published')
                                <span class="badge bg-success">Yayınlandı</span>
                            @else
                                <span class="badge bg-secondary">Taslak</span>
                            @endif
                        </td>
                        <td>{{ $post->published_at ? $post->published_at->format('d.m.Y H:i') : '-' }}</td>
                        <td>
                            <a href="{{ route('admin.blog.show', $post->id) }}" class="btn btn-sm btn-outline-info me-1">Detay</a>
                            <a href="{{ route('admin.blog.edit', $post->id) }}" class="btn btn-sm btn-outline-warning me-1">Düzenle</a>
                            <form action="{{ route('admin.blog.destroy', $post->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Silmek istediğinize emin misiniz?')">Sil</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-3">
        {{ $posts->links() }}
    </div>
</div>
<!-- Türkçe yorum: Admin paneli blog listeleme sayfası modern, Bootstrap tabanlı ve okunabilir şekilde güncellendi. -->
@endsection 