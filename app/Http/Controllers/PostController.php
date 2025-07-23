<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    // Blog yazılarını listeler
    public function index()
    {
        $posts = BlogPost::with('category')->orderByDesc('created_at')->paginate(10);
        return view('posts.index', compact('posts'));
        // Türkçe yorum: Tüm blog yazılarını listeler.
    }

    // Yeni blog yazısı oluşturma formu
    public function create()
    {
        $categories = BlogCategory::all();
        return view('posts.create', compact('categories'));
        // Türkçe yorum: Yeni blog yazısı ekleme formunu gösterir.
    }

    // Blog yazısı kaydetme
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'blog_category_id' => 'required|exists:blog_categories,id',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
        ]);
        $validated['slug'] = Str::slug($validated['title']);
        $validated['user_id'] = Auth::id();
        $validated['status'] = 'draft';
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('post-images', 'public');
        }
        BlogPost::create($validated);
        return redirect()->route('posts.index')->with('success', 'Blog yazısı eklendi.');
        // Türkçe yorum: Yeni blog yazısı kaydedilir.
    }

    // Blog yazısı düzenleme formu
    public function edit(BlogPost $post)
    {
        $categories = BlogCategory::all();
        return view('posts.edit', compact('post', 'categories'));
        // Türkçe yorum: Blog yazısı düzenleme formunu gösterir.
    }

    // Blog yazısı güncelleme
    public function update(Request $request, BlogPost $post)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'blog_category_id' => 'required|exists:blog_categories,id',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
        ]);
        $validated['slug'] = Str::slug($validated['title']);
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('post-images', 'public');
        }
        $post->update($validated);
        return redirect()->route('posts.index')->with('success', 'Blog yazısı güncellendi.');
        // Türkçe yorum: Blog yazısı güncellenir.
    }

    // Blog yazısı silme
    public function destroy(BlogPost $post)
    {
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Blog yazısı silindi.');
        // Türkçe yorum: Blog yazısı silinir.
    }
} 