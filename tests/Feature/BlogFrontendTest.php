<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\BlogPost;
use App\Models\BlogCategory;
use App\Models\Tag;
use App\Models\User;

class BlogFrontendTest extends TestCase
{
    use RefreshDatabase;

    public function test_blog_index_page_loads()
    {
        $response = $this->get('/blog');
        $response->assertStatus(200);
        // Türkçe yorum: Blog ana sayfası başarılı şekilde yükleniyor mu?
    }

    public function test_blog_show_page_loads()
    {
        $user = User::factory()->create();
        $category = BlogCategory::factory()->create();
        $post = BlogPost::factory()->create([
            'status' => 'published',
            'blog_category_id' => $category->id,
            'user_id' => $user->id,
        ]);
        $response = $this->get('/blog/' . $post->slug);
        $response->assertStatus(200);
        // Türkçe yorum: Tekil blog yazısı sayfası başarılı şekilde yükleniyor mu?
    }

    public function test_blog_category_page_loads()
    {
        $user = User::factory()->create();
        $category = BlogCategory::factory()->create();
        $post = BlogPost::factory()->create([
            'status' => 'published',
            'blog_category_id' => $category->id,
            'user_id' => $user->id,
        ]);
        $response = $this->get('/blog/category/' . $category->slug);
        $response->assertStatus(200);
        // Türkçe yorum: Kategori arşiv sayfası başarılı şekilde yükleniyor mu?
    }

    public function test_blog_tag_page_loads()
    {
        $user = User::factory()->create();
        $category = BlogCategory::factory()->create();
        $tag = Tag::factory()->create();
        $post = BlogPost::factory()->create([
            'status' => 'published',
            'blog_category_id' => $category->id,
            'user_id' => $user->id,
        ]);
        $post->tags()->attach($tag->id);
        $response = $this->get('/blog/tag/' . $tag->slug);
        $response->assertStatus(200);
        // Türkçe yorum: Etiket arşiv sayfası başarılı şekilde yükleniyor mu?
    }

    public function test_blog_search_page_loads()
    {
        $user = User::factory()->create();
        $category = BlogCategory::factory()->create();
        $post = BlogPost::factory()->create([
            'status' => 'published',
            'title' => 'Laravel Test',
            'blog_category_id' => $category->id,
            'user_id' => $user->id,
        ]);
        $response = $this->get('/blog/search?q=Laravel');
        $response->assertStatus(200);
        $response->assertSee('Laravel');
        // Türkçe yorum: Arama sayfası ve sonuçları başarılı şekilde yükleniyor mu?
    }
} 