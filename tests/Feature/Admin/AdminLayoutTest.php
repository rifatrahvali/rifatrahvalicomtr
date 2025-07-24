<?php
namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Spatie\Permission\Models\Role;

class AdminLayoutTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function admin_dashboard_gorunur_ve_menu_linkleri_var()
    {
        // Türkçe yorum: Testte admin rolü yoksa oluşturuluyor
        if (!Role::where('name', 'Admin')->exists()) {
            Role::create(['name' => 'Admin']);
        }
        $admin = User::factory()->create();
        $admin->assignRole('Admin');

        $response = $this->actingAs($admin)->get('/secure-admin/dashboard');
        $response->assertStatus(200);
        $response->assertSee('Yönetim Paneline Hoşgeldiniz');
        $response->assertSee('Galeri');
        $response->assertSee('Referanslar');
        $response->assertSee('Kullanıcılar');
        // Türkçe yorum: Dashboard ve menüdeki ana başlıklar kontrol ediliyor
    }

    /** @test */
    public function admin_olmayan_kullanici_erisemez()
    {
        // Türkçe yorum: Sıradan kullanıcı admin paneline erişemez
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/secure-admin/dashboard');
        $response->assertStatus(403);
        // Türkçe yorum: Yetkisiz kullanıcıya 403 Forbidden dönmeli
    }

    /** @test */
    public function giris_yapmayan_kullanici_login_sayfasina_yonlendirilir()
    {
        // Türkçe yorum: Giriş yapmayan kullanıcı admin paneline erişemez
        $response = $this->get('/secure-admin/dashboard');
        $response->assertRedirect('/login');
        // Türkçe yorum: Giriş yapılmadıysa login sayfasına yönlendirme kontrolü
    }

    /** @test */
    public function dashboard_istatistikler_grafik_ve_son_icerikler_gorunur()
    {
        // Türkçe yorum: Admin rolü yoksa oluşturuluyor
        if (!\Spatie\Permission\Models\Role::where('name', 'Admin')->exists()) {
            \Spatie\Permission\Models\Role::create(['name' => 'Admin']);
        }
        $admin = \App\Models\User::factory()->create();
        $admin->assignRole('Admin');
        // Türkçe yorum: Test verisi olarak blog, galeri, referans, kategori ekleniyor
        $kategori = \App\Models\BlogCategory::factory()->create();
        \App\Models\BlogPost::factory()->count(2)->create(['blog_category_id' => $kategori->id]);
        \App\Models\Gallery::factory()->count(1)->create();
        \App\Models\Reference::factory()->count(1)->create();
        \App\Models\BlogCategory::factory()->count(1)->create();
        $response = $this->actingAs($admin)->get('/secure-admin/dashboard');
        $response->assertStatus(200);
        $response->assertSee('Kullanıcılar');
        $response->assertSee('Blog Yazıları');
        $response->assertSee('Galeri');
        $response->assertSee('Referanslar');
        $response->assertSee('Kategoriler');
        $response->assertSee('Son 6 Ayda Eklenen Blog Yazısı');
        $response->assertSee('Son Bloglar');
        $response->assertSee('Son Kullanıcılar');
        $response->assertSee('Yeni Blog Yazısı Ekle');
        // Türkçe yorum: Dashboard istatistik, grafik ve son içerik bölümleri kontrol ediliyor
    }

    /** @test */
    public function admin_paneline_token_veya_yetki_olmadan_erisilemez()
    {
        // Türkçe: Giriş yapmayan kullanıcı admin paneline erişemez
        $response = $this->get('/secure-admin/dashboard');
        $response->assertRedirect('/login');
        // Türkçe: Giriş yapılmadıysa login sayfasına yönlendirme kontrolü

        // Türkçe: Sıradan kullanıcı admin paneline erişemez
        $user = \App\Models\User::factory()->create();
        $response = $this->actingAs($user)->get('/secure-admin/dashboard');
        $response->assertStatus(403);
        // Türkçe: Yetkisiz kullanıcıya 403 Forbidden dönmeli
    }
} 