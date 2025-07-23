<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BlogFrontendPolishTest extends TestCase
{
    use RefreshDatabase; // Türkçe: Test veritabanını her testte sıfırlar

    public function setUp(): void
    {
        parent::setUp();
        config(['app.locale' => 'tr']); // Türkçe: Testlerde locale Türkçe olsun
    }

    /** @test */
    public function blog_post_tipografi_ve_kod_blogu_gorunur()
    {
        $user = User::factory()->create();
        $kategori = BlogCategory::factory()->create();
        $post = BlogPost::factory()->create([
            'user_id' => $user->id,
            'blog_category_id' => $kategori->id,
            'title' => 'Test Blog',
            'content' => '<h2>Alt Başlık</h2><p>Paragraf metni</p><pre><code class="language-php">echo "Merhaba";</code></pre>',
            'status' => 'published', // Türkçe: Yayınlanmış olarak işaretle
        ]);
        $response = $this->get('/blog/' . $post->slug);
        $response->assertSeeText('Test Blog');
        $response->assertSeeText('Alt Başlık');
        $response->assertSeeText('Paragraf metni');
        $response->assertSee('language-php');
        // Türkçe: Blog post tipografi ve kod bloğu doğru şekilde render ediliyor mu kontrol edilir
    }

    /** @test */
    public function blog_post_galeri_ve_paylasim_butonlari_gorunur()
    {
        $user = User::factory()->create();
        $kategori = BlogCategory::factory()->create();
        $post = BlogPost::factory()->create([
            'user_id' => $user->id,
            'blog_category_id' => $kategori->id,
            'content' => '<img src="/test.jpg" alt="Test Görsel">',
            'status' => 'published', // Türkçe: Yayınlanmış olarak işaretle
        ]);
        $response = $this->get('/blog/' . $post->slug);
        $response->assertSeeText('Paylaş:');
        $response->assertSeeText('Twitter');
        $response->assertSeeText('Facebook');
        $response->assertSeeText('LinkedIn');
        $response->assertSee('test.jpg');
        // Türkçe: Galeri görseli ve paylaşım butonları doğru şekilde render ediliyor mu kontrol edilir
    }

    /** @test */
    public function blog_post_ilgili_yazilar_gorunur()
    {
        $user = User::factory()->create();
        $kategori = BlogCategory::factory()->create();
        $post = BlogPost::factory()->create([
            'user_id' => $user->id,
            'blog_category_id' => $kategori->id,
            'title' => 'Ana Yazı',
            'status' => 'published', // Türkçe: Yayınlanmış olarak işaretle
        ]);
        $related = BlogPost::factory()->create([
            'user_id' => $user->id,
            'blog_category_id' => $kategori->id,
            'title' => 'İlgili Yazı',
            'status' => 'published', // Türkçe: Yayınlanmış olarak işaretle
        ]);
        $response = $this->get('/blog/' . $post->slug);
        $response->assertSeeText('İlgili Yazılar');
        $response->assertSeeText('İlgili Yazı');
        // Türkçe: İlgili yazılar bölümü doğru şekilde render ediliyor mu kontrol edilir
    }
}
