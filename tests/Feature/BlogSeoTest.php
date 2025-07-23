<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\BlogPost;
use App\Models\BlogCategory;
use App\Models\User;

class BlogSeoTest extends TestCase
{
    use RefreshDatabase;

    public function test_blog_index_has_meta_tags()
    {
        $response = $this->get('/blog');
        $response->assertSee('<title>', false);
        $response->assertSee('meta name="description"', false);
        // Türkçe yorum: Blog ana sayfasında title ve description meta tag'leri var mı?
    }

    public function test_blog_show_has_seo_tags()
    {
        $user = User::factory()->create();
        $category = BlogCategory::factory()->create();
        $post = BlogPost::factory()->create([
            'status' => 'published',
            'blog_category_id' => $category->id,
            'user_id' => $user->id,
            'title' => 'SEO Test Post',
            'content' => 'SEO test içeriği',
        ]);
        $response = $this->get('/blog/' . $post->slug);
        $response->assertSee('<title>', false);
        $response->assertSeeInOrder(['meta', 'name="description"'], false);
        $response->assertSee('og:title', false);
        $response->assertSee('twitter:card', false);
        $response->assertSee('application/ld+json', false);
        // Türkçe yorum: Tekil yazı sayfasında SEO, Open Graph, Twitter Card ve JSON-LD tag'leri var mı?
    }

    public function test_sitemap_xml_endpoint()
    {
        $user = User::factory()->create();
        $category = BlogCategory::factory()->create();
        $post = BlogPost::factory()->create([
            'status' => 'published',
            'blog_category_id' => $category->id,
            'user_id' => $user->id,
        ]);
        $response = $this->get('/sitemap.xml');
        $response->assertStatus(200);
        $response->assertSee('<?xml', false);
        $response->assertSee('<urlset', false);
        $response->assertSee($post->slug);
        // Türkçe yorum: Sitemap endpointi doğru XML ve içerik döndürüyor mu?
    }
} 