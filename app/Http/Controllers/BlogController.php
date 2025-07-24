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
            ->select(['id', 'title', 'slug', 'blog_category_id', 'image', 'status', 'published_at'])
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
        $relatedPosts = $post->relatedPosts();
        return view('blog.show', compact('post', 'relatedPosts'));
        // Türkçe yorum: Seçilen blog yazısını ve ilgili yazıları detaylı gösterir.
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
            ->select(['id', 'title', 'slug', 'blog_category_id', 'image', 'status', 'published_at', 'content'])
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

    // Büyük veri setlerinde chunk ile toplu işleme örneği
    public function exportAllTitles()
    {
        $titles = [];
        BlogPost::select('id', 'title')->chunk(100, function($posts) use (&$titles) {
            foreach ($posts as $post) {
                $titles[] = $post->title;
            }
        });
        return response()->json(['titles' => $titles]);
        // Türkçe: Tüm blog başlıklarını bellek dostu şekilde chunk ile çeker.
    }
} 