<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\BlogPost;
use App\Models\BlogCategory;
use App\Models\Tag;
use App\Models\User;

class BlogApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_posts_endpoint_returns_paginated_posts()
    {
        $user = User::factory()->create();
        $category = BlogCategory::factory()->create();
        BlogPost::factory()->count(3)->create([
            'status' => 'published',
            'blog_category_id' => $category->id,
            'user_id' => $user->id,
        ]);
        $response = $this->getJson('/api/v1/blog/posts');
        $response->assertStatus(200)->assertJsonStructure(['data', 'links', 'meta']);
        // Türkçe yorum: Blog yazıları paginated olarak dönüyor mu?
    }

    public function test_show_endpoint_returns_post_detail()
    {
        $user = User::factory()->create();
        $category = BlogCategory::factory()->create();
        $post = BlogPost::factory()->create([
            'status' => 'published',
            'blog_category_id' => $category->id,
            'user_id' => $user->id,
        ]);
        $response = $this->getJson('/api/v1/blog/posts/' . $post->slug);
        $response->assertStatus(200)->assertJsonStructure(['data' => ['id', 'title', 'slug', 'content']]);
        // Türkçe yorum: Tekil yazı detayları dönüyor mu?
    }

    public function test_categories_endpoint_returns_categories()
    {
        BlogCategory::factory()->count(2)->create();
        $response = $this->getJson('/api/v1/blog/categories');
        $response->assertStatus(200)->assertJsonStructure(['data' => [['id', 'name', 'slug']]]);
        // Türkçe yorum: Kategoriler listeleniyor mu?
    }

    public function test_category_posts_endpoint_returns_posts()
    {
        $user = User::factory()->create();
        $category = BlogCategory::factory()->create();
        BlogPost::factory()->create([
            'status' => 'published',
            'blog_category_id' => $category->id,
            'user_id' => $user->id,
        ]);
        $response = $this->getJson('/api/v1/blog/categories/' . $category->slug);
        $response->assertStatus(200)->assertJsonStructure(['data']);
        // Türkçe yorum: Kategoriye ait yazılar dönüyor mu?
    }

    public function test_tags_endpoint_returns_tags()
    {
        Tag::factory()->count(2)->create();
        $response = $this->getJson('/api/v1/blog/tags');
        $response->assertStatus(200)->assertJsonStructure(['data' => [['id', 'name', 'slug']]]);
        // Türkçe yorum: Etiketler listeleniyor mu?
    }

    public function test_tag_posts_endpoint_returns_posts()
    {
        $user = User::factory()->create();
        $category = BlogCategory::factory()->create();
        $tag = Tag::factory()->create();
        $post = BlogPost::factory()->create([
            'status' => 'published',
            'blog_category_id' => $category->id,
            'user_id' => $user->id,
        ]);
        $post->tags()->attach($tag);
        $response = $this->getJson('/api/v1/blog/tags/' . $tag->slug);
        $response->assertStatus(200)->assertJsonStructure(['data']);
        // Türkçe yorum: Etikete ait yazılar dönüyor mu?
    }

    public function test_search_endpoint_returns_results()
    {
        $user = User::factory()->create();
        $category = BlogCategory::factory()->create();
        BlogPost::factory()->create([
            'status' => 'published',
            'blog_category_id' => $category->id,
            'user_id' => $user->id,
            'title' => 'Aranacak Başlık',
        ]);
        $response = $this->getJson('/api/v1/blog/search?q=Aranacak');
        $response->assertStatus(200)->assertJsonStructure(['data']);
        // Türkçe yorum: Arama endpointi doğru sonuç dönüyor mu?
    }
} 