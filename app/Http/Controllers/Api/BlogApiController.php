<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\BlogCategory;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Resources\BlogPostResource;
use App\Http\Resources\BlogCategoryResource;
use App\Http\Resources\TagResource;

class BlogApiController extends Controller
{
    // Tüm yayınlanmış blog yazılarını (paginated) döndürür
    public function posts(Request $request)
    {
        $posts = BlogPost::with(['category', 'tags'])
            ->where('status', 'published')
            ->orderByDesc('published_at')
            ->paginate($request->get('per_page', 10));
        return BlogPostResource::collection($posts);
        // Türkçe yorum: Yayınlanmış blog yazılarını resource ile döndürür.
    }

    // Tekil blog yazısı detayını döndürür
    public function show($slug)
    {
        $post = BlogPost::with(['category', 'tags'])
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();
        return new BlogPostResource($post);
        // Türkçe yorum: Seçilen blog yazısının detayını resource ile döndürür.
    }

    // Tüm kategorileri döndürür
    public function categories()
    {
        $categories = BlogCategory::all();
        return BlogCategoryResource::collection($categories);
        // Türkçe yorum: Tüm blog kategorilerini resource ile döndürür.
    }

    // Bir kategorideki yazıları döndürür
    public function categoryPosts($slug, Request $request)
    {
        $category = BlogCategory::where('slug', $slug)->firstOrFail();
        $posts = $category->posts()->where('status', 'published')->orderByDesc('published_at')->paginate($request->get('per_page', 10));
        return BlogPostResource::collection($posts);
        // Türkçe yorum: Seçilen kategoriye ait yayınlanmış yazıları resource ile döndürür.
    }

    // Tüm etiketleri döndürür
    public function tags()
    {
        $tags = Tag::all();
        return TagResource::collection($tags);
        // Türkçe yorum: Tüm blog etiketlerini resource ile döndürür.
    }

    // Bir etikete ait yazıları döndürür
    public function tagPosts($slug, Request $request)
    {
        $tag = Tag::where('slug', $slug)->firstOrFail();
        $posts = $tag->posts()->where('status', 'published')->orderByDesc('published_at')->paginate($request->get('per_page', 10));
        return BlogPostResource::collection($posts);
        // Türkçe yorum: Seçilen etikete ait yayınlanmış yazıları resource ile döndürür.
    }

    // Blog arama endpointi
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
            ->paginate($request->get('per_page', 10));
        return BlogPostResource::collection($posts);
        // Türkçe yorum: Arama sorgusuna uygun yayınlanmış yazıları resource ile döndürür.
    }
} 