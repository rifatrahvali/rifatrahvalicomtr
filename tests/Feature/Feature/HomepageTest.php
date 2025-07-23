<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\BlogPost;
use App\Models\Gallery;
use App\Models\UserProfile;

class HomepageTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function ana_sayfa_hero_ve_cv_ozeti_gorunur()
    {
        $user = \App\Models\User::factory()->create();
        $profile = \App\Models\UserProfile::factory()->create(['user_id' => $user->id, 'bio' => 'Kısa özgeçmiş test']);
        $response = $this->get('/');
        $response->assertSee('Merhaba, ben Rıfat Rahvali');
        $response->assertSee('CV&amp;amp;amp;amp;amp;#039;mi Görüntüle');
        $response->assertSee('Kısa Özgeçmiş');
        $response->assertSee('Kısa özgeçmiş test');
        // Türkçe: Hero alanı ve CV özeti bölümü doğru şekilde render ediliyor mu kontrol edilir
    }

    /** @test */
    public function ana_sayfa_son_blog_yazilari_gorunur()
    {
        $user = \App\Models\User::factory()->create();
        $kategori = \App\Models\BlogCategory::factory()->create();
        \App\Models\BlogPost::factory()->count(2)->create([
            'title' => 'Test Blog',
            'user_id' => $user->id,
            'blog_category_id' => $kategori->id
        ]);
        $response = $this->get('/');
        $response->assertSee('Son Blog Yazıları');
        $response->assertSee('Test Blog');
        // Türkçe: Son blog yazıları bölümü doğru şekilde render ediliyor mu kontrol edilir
    }

    /** @test */
    public function ana_sayfa_galeri_ve_iletisim_gorunur()
    {
        \App\Models\Gallery::factory()->create(['title' => 'Test Galeri', 'path' => '/test.jpg']);
        $response = $this->get('/');
        $response->assertSee('Öne Çıkan Projeler');
        $response->assertSee('Test Galeri');
        $response->assertSee('Galeriye Git');
        $response->assertSee('İletişim &amp;amp;amp;amp;amp;amp;amp;amp; Sosyal Medya');
        $response->assertSee('info@rifatrahvali.com.tr');
        $response->assertSee('Twitter');
        $response->assertSee('GitHub');
        // Türkçe: Galeri ve iletişim bölümleri doğru şekilde render ediliyor mu kontrol edilir
    }
}
