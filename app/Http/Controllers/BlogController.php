<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\BlogCategory;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache; // Türkçe: Cache facade'ı eklendi

class BlogController extends Controller
{
    // Blog ana sayfa: yayınlanmış yazıların listesi
    public function index(Request $request)
    {
        $query = BlogPost::with(['category', 'tags'])
            ->select(['id', 'title', 'slug', 'blog_category_id', 'image', 'status', 'published_at'])
            ->where('status', 'published')
            ->orderByDesc('published_at');
        $posts = Cache::remember('blog_index_page_' . $request->get('page', 1), 60, function() use ($query) {
            return $query->paginate(10);
        });
        // Türkçe: Blog ana sayfa sorgusu 60 saniye boyunca cache'de tutulur.
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
        $category = Cache::rememberForever('blog_category_' . $slug, function() use ($slug) {
            return \App\Models\BlogCategory::where('slug', $slug)->firstOrFail();
        });
        $posts = Cache::remember('blog_category_posts_' . $slug . '_' . $request->get('page', 1), 60, function() use ($category) {
            return $category->posts()->where('status', 'published')->orderByDesc('published_at')->paginate(10);
        });
        // Türkçe: Kategori ve yazı listesi cache'den çekilir.
        return view('blog.category', compact('category', 'posts'));
        // Türkçe yorum: Seçilen kategoriye ait yayınlanmış yazıları listeler.
    }

    // Etiket arşivi
    public function tagArchive($slug)
    {
        $tag = Cache::rememberForever('blog_tag_' . $slug, function() use ($slug) {
            return \App\Models\Tag::where('slug', $slug)->firstOrFail();
        });
        $posts = Cache::remember('blog_tag_posts_' . $slug . '_' . $request->get('page', 1), 60, function() use ($tag) {
            return $tag->posts()->where('status', 'published')->orderByDesc('published_at')->paginate(10);
        });
        // Türkçe: Etiket ve yazı listesi cache'den çekilir.
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

    public function clearBlogCache()
    {
        Cache::forget('blog_index_page_1');
        Cache::forget('api_blog_posts_1');
        Cache::forget('api_blog_categories');
        Cache::forget('api_blog_tags');
        // Türkçe: Blog ana sayfa, kategori ve etiket cache'leri temizlenir.
    }

    // Blog yazısı kaydetme
    public function store(Request $request)
    {
        $this->clearBlogCache(); // Türkçe: Yeni yazı eklenince cache temizlenir.
    }

    // Blog yazısı güncelleme
    public function update(Request $request, BlogPost $post)
    {
        $this->clearBlogCache(); // Türkçe: Yazı güncellenince cache temizlenir.
    }

    // Blog yazısı silme
    public function destroy(BlogPost $post)
    {
        $this->clearBlogCache(); // Türkçe: Yazı silinince cache temizlenir.
    }
} 