@extends('layouts.app')

@section('title', 'Blog | rifatrahvali.com.tr')
@section('meta_description', 'Kişisel blog yazıları, güncel içerikler ve teknik makaleler.')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">Blog</h1>
    <form action="{{ route('blog.search') }}" method="get" class="mb-4">
        <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="Yazı, etiket veya kategori ara...">
            <button class="btn btn-primary" type="submit">Ara</button>
        </div>
    </form>
    <div class="row g-4">
        @foreach($posts as $post)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100">
                    @if($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top" alt="{{ $post->title }}">
                    @endif
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">
                            <a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
                        </h5>
                        <div class="mb-2 text-muted small">
                            <span>{{ $post->published_at ? $post->published_at->format('d M Y') : $post->created_at->format('d M Y') }}</span>
                            @if($post->category)
                                | <a href="{{ route('blog.category', $post->category->slug) }}">{{ $post->category->name }}</a>
                            @endif
                        </div>
                        <div class="mb-2">
                            @foreach($post->tags as $tag)
                                <a href="{{ route('blog.tag', $tag->slug) }}" class="badge bg-secondary text-decoration-none">#{{ $tag->name }}</a>
                            @endforeach
                        </div>
                        <p class="card-text flex-grow-1">{{ \Illuminate\Support\Str::limit(strip_tags($post->content), 120) }}</p>
                        <a href="{{ route('blog.show', $post->slug) }}" class="btn btn-outline-primary mt-auto">Devamını Oku</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="mt-4">
        {{ $posts->links() }}
    </div>
</div>
@endsection

{{-- Türkçe yorum: Blog ana sayfası, yayınlanmış yazıları kartlı ve responsive şekilde listeler. --}} 