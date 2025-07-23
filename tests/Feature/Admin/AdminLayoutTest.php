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
} 