<?php
namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Spatie\Permission\Models\Role;

class UserManagementTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        if (!Role::where('name', 'Admin')->exists()) {
            Role::create(['name' => 'Admin']);
        }
        if (!Role::where('name', 'Editor')->exists()) {
            Role::create(['name' => 'Editor']);
        }
    }

    /** @test */
    public function admin_kullanici_ekleyebilir_ve_rol_atayabilir()
    {
        // Türkçe yorum: Admin ile giriş yapılıyor
        $admin = User::factory()->create();
        $admin->assignRole('Admin');
        $response = $this->actingAs($admin)->post(route('admin.users.store'), [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'roles' => ['Editor'],
        ]);
        $response->assertRedirect(route('admin.users.index'));
        $this->assertDatabaseHas('users', ['email' => 'test@example.com']);
        $user = User::where('email', 'test@example.com')->first();
        $this->assertTrue($user->hasRole('Editor'));
        // Türkçe yorum: Kullanıcı başarıyla eklendi ve rol atandı
    }

    /** @test */
    public function admin_kullanici_duzenleyebilir_ve_rol_degistirebilir()
    {
        $admin = User::factory()->create();
        $admin->assignRole('Admin');
        $user = User::factory()->create(['name' => 'Old Name']);
        $user->assignRole('Editor');
        $response = $this->actingAs($admin)->put(route('admin.users.update', $user), [
            'name' => 'New Name',
            'email' => $user->email,
            'roles' => ['Admin'],
        ]);
        $response->assertRedirect(route('admin.users.index'));
        $user->refresh();
        $this->assertEquals('New Name', $user->name);
        $this->assertTrue($user->hasRole('Admin'));
        // Türkçe yorum: Kullanıcı adı ve rolü başarıyla güncellendi
    }

    /** @test */
    public function admin_kullanici_silebilir()
    {
        $admin = User::factory()->create();
        $admin->assignRole('Admin');
        $user = User::factory()->create();
        $response = $this->actingAs($admin)->delete(route('admin.users.destroy', $user));
        $response->assertRedirect(route('admin.users.index'));
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
        // Türkçe yorum: Kullanıcı başarıyla silindi
    }

    /** @test */
    public function admin_olmayan_kullanici_erisemez()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get(route('admin.users.index'));
        $response->assertStatus(403);
        // Türkçe yorum: Yetkisiz kullanıcı erişemez
    }
} 