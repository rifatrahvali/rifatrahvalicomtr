<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\BlogCategory;
use App\Models\Tag;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    // Blog ana sayfa: yayınlanmış yazıların listesi
    public function index(Request $request)
    {
        $query = BlogPost::with(['category', 'tags'])
            ->where('status', 'published')
            ->orderByDesc('published_at');
        $posts = $query->paginate(10);
        return view('blog.index', compact('posts'));
        // Türkçe yorum: Yayınlanmış blog yazılarını listeler.
    }

    // Tekil blog yazısı gösterimi
    public function show($slug)
    {
        $post = BlogPost::with(['category', 'tags'])
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();
        return view('blog.show', compact('post'));
        // Türkçe yorum: Seçilen blog yazısını detaylı gösterir.
    }

    // Kategori arşivi
    public function categoryArchive($slug)
    {
        $category = BlogCategory::where('slug', $slug)->firstOrFail();
        $posts = $category->posts()->where('status', 'published')->orderByDesc('published_at')->paginate(10);
        return view('blog.category', compact('category', 'posts'));
        // Türkçe yorum: Seçilen kategoriye ait yayınlanmış yazıları listeler.
    }

    // Etiket arşivi
    public function tagArchive($slug)
    {
        $tag = Tag::where('slug', $slug)->firstOrFail();
        $posts = $tag->posts()->where('status', 'published')->orderByDesc('published_at')->paginate(10);
        return view('blog.tag', compact('tag', 'posts'));
        // Türkçe yorum: Seçilen etikete ait yayınlanmış yazıları listeler.
    }

    // Blog arama
    public function search(Request $request)
    {
        $q = $request->input('q');
        $posts = BlogPost::with(['category', 'tags'])
            ->where('status', 'published')
            ->where(function($query) use ($q) {
                $query->where('title', 'like', "%$q%")
                      ->orWhere('content', 'like', "%$q%")
                      ->orWhereHas('tags', function($tagQuery) use ($q) {
                          $tagQuery->where('name', 'like', "%$q%") ;
                      });
            })
            ->orderByDesc('published_at')
            ->paginate(10);
        return view('blog.search', compact('posts', 'q'));
        // Türkçe yorum: Arama sorgusuna uygun yayınlanmış yazıları listeler.
    }
} 