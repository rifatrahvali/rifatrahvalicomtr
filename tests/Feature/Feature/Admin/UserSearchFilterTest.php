<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Spatie\Permission\Models\Role;

class UserSearchFilterTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function admin_isim_ile_kullanici_arayabilir()
    {
        if (!Role::where('name', 'admin')->exists()) {
            Role::create(['name' => 'admin']);
        }
        $admin = User::factory()->create(['name' => 'Yönetici Admin']);
        $admin->assignRole('admin');
        $user = User::factory()->create(['name' => 'Ahmet AramaTest']);
        $response = $this->actingAs($admin)
            ->get(route('admin.users.index', ['name' => 'Ahmet']));
        $response->assertSee('Ahmet AramaTest');
        // Türkçe: Sadece aranan isimdeki kullanıcı listelenir
    }

    /** @test */
    public function admin_email_ile_kullanici_arayabilir()
    {
        if (!Role::where('name', 'admin')->exists()) {
            Role::create(['name' => 'admin']);
        }
        $admin = User::factory()->create();
        $admin->assignRole('admin');
        $user = User::factory()->create(['email' => 'arama@example.com']);
        $this->actingAs($admin)
            ->get(route('admin.users.index', ['email' => 'arama@']))
            ->assertSee('arama@example.com');
        // Türkçe: E-posta ile arama sonucu doğru kullanıcıyı getirir
    }

    /** @test */
    public function admin_rol_ile_kullanici_filtreleyebilir()
    {
        if (!Role::where('name', 'admin')->exists()) {
            Role::create(['name' => 'admin']);
        }
        if (!Role::where('name', 'editor')->exists()) {
            Role::create(['name' => 'editor']);
        }
        $admin = User::factory()->create(['name' => 'Yönetici Admin']);
        $admin->assignRole('admin');
        $editor = User::factory()->create(['name' => 'Editör Kullanıcı']);
        $editor->assignRole('editor');
        $response = $this->actingAs($admin)
            ->get(route('admin.users.index', ['role' => ['editor']]));
        $response->assertSee('Editör Kullanıcı');
        // Türkçe: Sadece seçili roldeki kullanıcılar listelenir
    }

    /** @test */
    public function admin_durum_ile_kullanici_filtreleyebilir()
    {
        if (!Role::where('name', 'admin')->exists()) {
            Role::create(['name' => 'admin']);
        }
        $admin = User::factory()->create(['name' => 'Yönetici Admin']);
        $admin->assignRole('admin');
        $active = User::factory()->create(['name' => 'Aktif Kullanıcı']);
        $passive = User::factory()->create(['name' => 'Pasif Kullanıcı']);
        $passive->delete(); // Türkçe: Pasif kullanıcıyı soft delete ile sil
        $response = $this->actingAs($admin)
            ->get(route('admin.users.index', ['status' => 'active']));
        $response->assertSee('Aktif Kullanıcı');
        $response->assertDontSee('Pasif Kullanıcı');
        $response = $this->actingAs($admin)
            ->get(route('admin.users.index', ['status' => 'passive']));
        $response->assertSee('Pasif Kullanıcı');
        $response->assertDontSee('Aktif Kullanıcı');
        // Türkçe: Duruma göre filtreleme çalışır
    }

    /** @test */
    public function admin_kombinasyonlu_filtreleme_yapabilir()
    {
        if (!Role::where('name', 'admin')->exists()) {
            Role::create(['name' => 'admin']);
        }
        if (!Role::where('name', 'editor')->exists()) {
            Role::create(['name' => 'editor']);
        }
        $admin = User::factory()->create(['name' => 'Yönetici Admin']);
        $admin->assignRole('admin');
        $editor = User::factory()->create(['name' => 'Editör Arama', 'email' => 'edit@or.com']);
        $editor->assignRole('editor');
        $response = $this->actingAs($admin)
            ->get(route('admin.users.index', ['name' => 'Editör', 'role' => ['editor'], 'email' => 'edit@']));
        $response->assertSee('Editör Arama');
        // Türkçe: Birden fazla filtre birlikte çalışır
    }
}
