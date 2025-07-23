<?php

namespace App\Http\Controllers;

use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    // Kategori listesi (hiyerarşik)
    public function index()
    {
        $categories = BlogCategory::with('children')->whereNull('parent_id')->get();
        return view('categories.index', compact('categories'));
        // Türkçe yorum: Tüm ana ve alt kategorileri hiyerarşik olarak listeler.
    }

    // Yeni kategori oluşturma formu
    public function create()
    {
        $parents = BlogCategory::whereNull('parent_id')->get();
        return view('categories.create', compact('parents'));
        // Türkçe yorum: Yeni kategori ekleme formunu gösterir.
    }

    // Kategori kaydetme
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'parent_id' => 'nullable|exists:blog_categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $validated['slug'] = Str::slug($validated['name']);
        // Türkçe yorum: Kategori resmi yükleme (hazırlık)
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('category-images', 'public');
        }
        BlogCategory::create($validated);
        return redirect()->route('categories.index')->with('success', 'Kategori eklendi.');
        // Türkçe yorum: Yeni kategori kaydedilir.
    }

    // Kategori düzenleme formu
    public function edit(BlogCategory $category)
    {
        $parents = BlogCategory::whereNull('parent_id')->where('id', '!=', $category->id)->get();
        return view('categories.edit', compact('category', 'parents'));
        // Türkçe yorum: Kategori düzenleme formunu gösterir.
    }

    // Kategori güncelleme
    public function update(Request $request, BlogCategory $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'parent_id' => 'nullable|exists:blog_categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $validated['slug'] = Str::slug($validated['name']);
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('category-images', 'public');
        }
        $category->update($validated);
        return redirect()->route('categories.index')->with('success', 'Kategori güncellendi.');
        // Türkçe yorum: Kategori güncellenir.
    }

    // Kategori silme
    public function destroy(BlogCategory $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Kategori silindi.');
        // Türkçe yorum: Kategori silinir.
    }
} 