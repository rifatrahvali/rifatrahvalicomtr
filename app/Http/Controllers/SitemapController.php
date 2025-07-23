<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\BlogCategory;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index()
    {
        $posts = BlogPost::where('status', 'published')->get();
        $categories = BlogCategory::all();
        $content = view('sitemap.xml', compact('posts', 'categories'));
        return response($content, 200)
            ->header('Content-Type', 'application/xml');
        // Türkçe yorum: Tüm yayınlanmış yazı ve kategorileri XML sitemap olarak döndürür.
    }
} 