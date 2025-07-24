<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Tag;

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
        $allTags = Tag::all();
        return view('posts.create', compact('categories', 'allTags'));
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
            'tags' => 'nullable|array',
            'tags.*' => 'string|max:100',
        ]);
        $validated['slug'] = Str::slug($validated['title']);
        $validated['user_id'] = Auth::id();
        $validated['status'] = 'draft';
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('post-images', 'public');
        }
        $post = BlogPost::create($validated);
        // Türkçe yorum: Etiketleri işle
        $tagIds = [];
        if ($request->filled('tags')) {
            foreach ($request->input('tags') as $tagName) {
                $tag = Tag::firstOrCreate([
                    'slug' => Str::slug($tagName)
                ], [
                    'name' => $tagName
                ]);
                $tagIds[] = $tag->id;
            }
        }
        $post->tags()->sync($tagIds);
        return redirect()->route('posts.index')->with('success', 'Blog yazısı eklendi.');
        // Türkçe yorum: Yeni blog yazısı kaydedilir.
    }

    // Blog yazısı düzenleme formu
    public function edit(BlogPost $post)
    {
        $categories = BlogCategory::all();
        $allTags = Tag::all();
        $selectedTags = $post->tags->pluck('name')->toArray();
        return view('posts.edit', compact('post', 'categories', 'allTags', 'selectedTags'));
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
            'tags' => 'nullable|array',
            'tags.*' => 'string|max:100',
        ]);
        // Türkçe: Başlık ve içerik alanlarını XSS ve zararlı HTML'den temizle
        $validated['title'] = \App\Services\Security\InputSanitizer::clean($validated['title']);
        $validated['content'] = \App\Services\Security\InputSanitizer::clean($validated['content']);
        $validated['slug'] = Str::slug($validated['title']);
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('post-images', 'public');
        }
        $post->update($validated);
        // Türkçe yorum: Etiketleri işle
        $tagIds = [];
        if ($request->filled('tags')) {
            foreach ($request->input('tags') as $tagName) {
                $tag = Tag::firstOrCreate([
                    'slug' => Str::slug($tagName)
                ], [
                    'name' => $tagName
                ]);
                $tagIds[] = $tag->id;
            }
        }
        $post->tags()->sync($tagIds);
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