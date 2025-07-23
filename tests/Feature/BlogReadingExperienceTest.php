<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\BlogPost;
use App\Models\BlogCategory;
use App\Models\Tag;
use App\Models\User;

class BlogReadingExperienceTest extends TestCase
{
    use RefreshDatabase;

    public function test_reading_time_is_displayed()
    {
        $user = User::factory()->create();
        $category = BlogCategory::factory()->create();
        $post = BlogPost::factory()->create([
            'status' => 'published',
            'blog_category_id' => $category->id,
            'user_id' => $user->id,
            'content' => str_repeat('kelime ', 500), // 500 kelime = 3 dk
        ]);
        $response = $this->get('/blog/' . $post->slug);
        $response->assertSee('dk okuma');
        // Türkçe yorum: Okuma süresi ekranda görünüyor mu?
    }

    public function test_related_posts_are_listed()
    {
        $user = User::factory()->create();
        $category = BlogCategory::factory()->create();
        $main = BlogPost::factory()->create([
            'status' => 'published',
            'blog_category_id' => $category->id,
            'user_id' => $user->id,
        ]);
        $related = BlogPost::factory()->create([
            'status' => 'published',
            'blog_category_id' => $category->id,
            'user_id' => $user->id,
            'title' => 'İlgili Yazı',
        ]);
        $response = $this->get('/blog/' . $main->slug);
        $response->assertSee('İlgili Yazılar');
        $response->assertSee('İlgili Yazı');
        // Türkçe yorum: İlgili yazılar başlığı ve ilgili yazı listede var mı?
    }

    public function test_social_share_buttons_exist()
    {
        $user = User::factory()->create();
        $category = BlogCategory::factory()->create();
        $post = BlogPost::factory()->create([
            'status' => 'published',
            'blog_category_id' => $category->id,
            'user_id' => $user->id,
        ]);
        $response = $this->get('/blog/' . $post->slug);
        $response->assertSee('Paylaş:');
        $response->assertSee('Twitter');
        $response->assertSee('Facebook');
        $response->assertSee('LinkedIn');
        // Türkçe yorum: Sosyal paylaşım butonları ekranda var mı?
    }

    public function test_print_button_exists()
    {
        $user = User::factory()->create();
        $category = BlogCategory::factory()->create();
        $post = BlogPost::factory()->create([
            'status' => 'published',
            'blog_category_id' => $category->id,
            'user_id' => $user->id,
        ]);
        $response = $this->get('/blog/' . $post->slug);
        $response->assertSee('Yazdır');
        // Türkçe yorum: Yazdır butonu ekranda var mı?
    }
} 