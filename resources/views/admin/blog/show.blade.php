@extends('layouts.admin')
@section('title', 'Blog Yazısı Detayı')
@section('content')
<div class="container py-4" style="max-width: 700px;">
    <div class="mb-4">
        <a href="{{ route('admin.blog.index') }}" class="btn btn-light border rounded-pill px-4 py-2 mb-3" style="font-size: 15px;">&larr; Tüm Yazılar</a>
        <h2 class="fw-bold mb-2" style="font-size: 2rem; color: #1e293b;">{{ $post->title }}</h2>
        <div class="d-flex flex-wrap align-items-center gap-3 mb-3" style="font-size: 14px; color: #64748b;">
            <span>📅 {{ $post->published_at ? $post->published_at->format('d M Y') : $post->created_at->format('d M Y') }}</span>
            @if($post->category)
                <span>|</span>
                <span class="badge bg-gradient-primary text-white px-3 py-2" style="background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%); font-size: 13px;">🏷️ {{ $post->category->name }}</span>
            @endif
            <span>|</span>
            <span>Yazar: {{ $post->user->name ?? '-' }}</span>
            <span>|</span>
            @if($post->status === 'published')
                <span class="badge bg-success">Yayınlandı</span>
            @else
                <span class="badge bg-secondary">Taslak</span>
            @endif
        </div>
    </div>
    @if($post->image)
        <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="img-fluid rounded shadow mb-4" style="max-height: 350px; object-fit: cover; width: 100%;">
    @else
        <img src="/images/placeholder-blog.jpg" alt="Placeholder" class="img-fluid rounded shadow mb-4" style="max-height: 350px; object-fit: cover; width: 100%;">
    @endif
    <div class="blog-content mb-4" style="font-size: 1.08rem; line-height: 1.8; color: #374151;">
        {!! $post->content !!}
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.blog.edit', $post->id) }}" class="btn btn-warning rounded-pill px-4">Düzenle</a>
        <form action="{{ route('admin.blog.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Silmek istediğinize emin misiniz?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger rounded-pill px-4">Sil</button>
        </form>
    </div>
</div>
<!-- Türkçe yorum: Admin paneli blog detay sayfası modern, Bootstrap tabanlı ve okunabilir şekilde güncellendi. -->
@endsection 