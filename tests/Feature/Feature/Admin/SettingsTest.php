<?php

namespace Tests\Feature\Admin;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Spatie\Permission\Models\Role;

class SettingsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function admin_ayar_sayfasini_gorebilir()
    {
        // Türkçe: Testte admin rolü yoksa oluştur
        if (!Role::where('name', 'admin')->exists()) {
            Role::create(['name' => 'admin']);
        }
        // Türkçe: Admin kullanıcı oluşturuluyor
        $admin = User::factory()->create();
        $admin->assignRole('admin');
        // Türkçe: Ayar ekleniyor
        Setting::create(['key' => 'site_title', 'value' => 'Test', 'type' => 'string', 'group' => 'general']);
        // Türkçe: Admin olarak giriş yapılıyor
        $response = $this->actingAs($admin)->get(route('admin.settings.index'));
        $response->assertStatus(200);
        $response->assertSee('Site Ayarları');
    }

    /** @test */
    public function admin_ayar_guncelleyebilir()
    {
        // Türkçe: Testte admin rolü yoksa oluştur
        if (!Role::where('name', 'admin')->exists()) {
            Role::create(['name' => 'admin']);
        }
        // Türkçe: Admin kullanıcı oluşturuluyor
        $admin = User::factory()->create();
        $admin->assignRole('admin');
        // Türkçe: Ayar ekleniyor
        Setting::create(['key' => 'site_title', 'value' => 'Test', 'type' => 'string', 'group' => 'general']);
        // Türkçe: Admin olarak ayar güncelleniyor
        $response = $this->actingAs($admin)->post(route('admin.settings.update'), [
            'site_title' => 'Yeni Başlık',
        ]);
        $response->assertRedirect();
        $this->assertEquals('Yeni Başlık', Setting::where('key', 'site_title')->first()->value);
    }

    /** @test */
    public function admin_olmayan_erisim_engellenir()
    {
        // Türkçe: Normal kullanıcı oluşturuluyor
        $user = User::factory()->create();
        // Türkçe: Ayar ekleniyor
        Setting::create(['key' => 'site_title', 'value' => 'Test', 'type' => 'string', 'group' => 'general']);
        // Türkçe: Normal kullanıcı olarak erişim deneniyor
        $response = $this->actingAs($user)->get(route('admin.settings.index'));
        $response->assertStatus(403);
    }
}
