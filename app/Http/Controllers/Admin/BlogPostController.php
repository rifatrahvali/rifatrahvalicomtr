<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Services\Security\InputSanitizer;

class BlogPostController extends Controller
{
    /**
     * Yeni blog yazısı ekleme formunu gösterir.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Türkçe yorum: Blog yazısı ekleme formu (şimdilik basit bir placeholder)
        return view('admin.blog.create');
    }

    /**
     * Blog yazılarını listeler.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $posts = \App\Models\BlogPost::latest()->paginate(20);
        return view('admin.blog.index', compact('posts'));
        // Türkçe yorum: Tüm blog yazılarını sayfalı şekilde listeler.
    }

    /**
     * Blog yazısı kaydeder.
     *
     * @param  StoreBlogPostRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(\App\Http\Requests\Admin\StoreBlogPostRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        $data['blog_category_id'] = $request->input('blog_category_id');
        $data['slug'] = Str::slug($data['title']);
        if ($data['status'] === 'published' && empty($data['published_at'])) {
            $data['published_at'] = now();
        }
        $data['content'] = InputSanitizer::clean($data['content']);
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('blog-images', 'public');
        }
        $post = \App\Models\BlogPost::create($data);
        return redirect()->route('admin.blog.index')->with('success', 'Blog yazısı başarıyla eklendi.');
        // Türkçe yorum: Görsel yüklenirse güvenli şekilde storage'a kaydedilir ve yol veritabanına yazılır.
    }

    /**
     * Blog yazısını düzenleme formunu gösterir.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit(\App\Models\BlogPost $blog)
    {
        $post = $blog;
        return view('admin.blog.edit', compact('post'));
        // Türkçe yorum: Model binding ile blog yazısı düzenleme formu.
    }

    /**
     * Blog yazısını günceller.
     *
     * @param  UpdateBlogPostRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(\App\Http\Requests\Admin\UpdateBlogPostRequest $request, \App\Models\BlogPost $blog)
    {
        $post = $blog;
        $data = $request->validated();
        $data['blog_category_id'] = $request->input('blog_category_id');
        $data['slug'] = Str::slug($data['title']);
        if ($data['status'] === 'published' && empty($data['published_at'])) {
            $data['published_at'] = now();
        }
        $data['content'] = InputSanitizer::clean($data['content']);
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('blog-images', 'public');
        }
        $post->update($data);
        return redirect()->route('admin.blog.index')->with('success', 'Blog yazısı başarıyla güncellendi.');
        // Türkçe yorum: Görsel yüklenirse güvenli şekilde storage'a kaydedilir ve yol veritabanına yazılır.
    }

    /**
     * Blog yazısını siler.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(\App\Models\BlogPost $blog)
    {
        $blog->delete();
        return redirect()->route('admin.blog.index')->with('success', 'Blog yazısı silindi.');
        // Türkçe yorum: Model binding ile blog yazısı silinir.
    }

    /**
     * Blog yazısını detaylı gösterir.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show(\App\Models\BlogPost $blog)
    {
        $post = $blog;
        return view('admin.blog.show', compact('post'));
        // Türkçe yorum: Model binding ile blog yazısı detayını gösterir.
    }
} 