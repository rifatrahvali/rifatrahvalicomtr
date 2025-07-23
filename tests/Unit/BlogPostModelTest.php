<?php

namespace Tests\Unit;

use App\Models\BlogPost;
use App\Models\User;
use App\Models\BlogCategory;
use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BlogPostModelTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function blog_post_user_relationship_works()
    {
        $user = User::factory()->create();
        $cat = BlogCategory::factory()->create();
        $post = BlogPost::factory()->create([
            'user_id' => $user->id,
            'blog_category_id' => $cat->id,
        ]);
        $this->assertTrue($post->user->is($user));
        // Türkçe: Blog yazısı ile kullanıcı ilişkisi doğru çalışıyor mu kontrol edilir.
    }

    /** @test */
    public function blog_post_category_relationship_works()
    {
        $user = User::factory()->create();
        $cat = BlogCategory::factory()->create();
        $post = BlogPost::factory()->create([
            'user_id' => $user->id,
            'blog_category_id' => $cat->id,
        ]);
        $this->assertTrue($post->category->is($cat));
        // Türkçe: Blog yazısı ile kategori ilişkisi doğru çalışıyor mu kontrol edilir.
    }

    /** @test */
    public function blog_post_tags_relationship_works()
    {
        $user = \App\Models\User::factory()->create();
        $cat = \App\Models\BlogCategory::factory()->create();
        $post = \App\Models\BlogPost::factory()->create([
            'user_id' => $user->id,
            'blog_category_id' => $cat->id,
        ]);
        $tag = \App\Models\Tag::factory()->create();
        $post->tags()->attach($tag->id);
        $this->assertTrue($post->tags->contains($tag));
        // Türkçe: Blog yazısı ile etiket ilişkisi doğru çalışıyor mu kontrol edilir.
    }

    /** @test */
    public function blog_post_reading_time_calculates_correctly()
    {
        $user = User::factory()->create();
        $cat = BlogCategory::factory()->create();
        $content = str_repeat('kelime ', 400); // 400 kelime
        $post = BlogPost::factory()->create([
            'user_id' => $user->id,
            'blog_category_id' => $cat->id,
            'content' => $content
        ]);
        $this->assertEquals(2, $post->readingTime());
        // Türkçe: Okuma süresi (400 kelime için 2 dakika) doğru hesaplanıyor mu kontrol edilir.
    }

    /** @test */
    public function blog_post_related_posts_returns_expected_results()
    {
        $user = User::factory()->create();
        $cat = BlogCategory::factory()->create();
        $main = BlogPost::factory()->create(['user_id' => $user->id, 'blog_category_id' => $cat->id, 'status' => 'published']);
        $related1 = BlogPost::factory()->create(['user_id' => $user->id, 'blog_category_id' => $cat->id, 'status' => 'published']);
        $related2 = BlogPost::factory()->create(['user_id' => $user->id, 'blog_category_id' => $cat->id, 'status' => 'published']);
        $related3 = BlogPost::factory()->create(['user_id' => $user->id, 'blog_category_id' => $cat->id, 'status' => 'published']);
        $unrelated = BlogPost::factory()->create(['status' => 'published']);
        $results = $main->relatedPosts(3);
        $this->assertTrue($results->contains($related1));
        $this->assertTrue($results->contains($related2));
        $this->assertTrue($results->contains($related3));
        $this->assertFalse($results->contains($main));
        $this->assertFalse($results->contains($unrelated));
        // Türkçe: relatedPosts fonksiyonu aynı kategoriye sahip yayınlanmış yazıları döndürüyor mu kontrol edilir.
    }
} 