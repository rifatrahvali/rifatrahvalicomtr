<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Spatie\Permission\Models\Role;

class UserBulkActionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function admin_toplu_kullanicilari_silebilir()
    {
        // Türkçe: Admin rolü yoksa oluştur
        if (!Role::where('name', 'admin')->exists()) {
            Role::create(['name' => 'admin']);
        }
        $admin = User::factory()->create();
        $admin->assignRole('admin');
        $users = User::factory()->count(3)->create();
        $ids = $users->pluck('id')->toArray();
        $response = $this->actingAs($admin)->post(route('admin.users.bulk'), [
            'ids' => $ids,
            'action' => 'delete',
        ]);
        $response->assertStatus(200);
        foreach ($ids as $id) {
            $this->assertDatabaseMissing('users', ['id' => $id]);
        }
    }

    /** @test */
    public function admin_toplu_rol_atayabilir()
    {
        // Türkçe: Admin ve editor rolü yoksa oluştur
        if (!Role::where('name', 'admin')->exists()) {
            Role::create(['name' => 'admin']);
        }
        if (!Role::where('name', 'editor')->exists()) {
            Role::create(['name' => 'editor']);
        }
        $admin = User::factory()->create();
        $admin->assignRole('admin');
        $users = User::factory()->count(2)->create();
        $ids = $users->pluck('id')->toArray();
        $response = $this->actingAs($admin)->post(route('admin.users.bulk'), [
            'ids' => $ids,
            'action' => 'set_role',
            'role' => 'editor',
        ]);
        $response->assertStatus(200);
        foreach ($users as $user) {
            $this->assertTrue($user->fresh()->hasRole('editor'));
        }
    }

    /** @test */
    public function admin_olmayan_toplu_islem_yapamaz()
    {
        $user = User::factory()->create();
        $users = User::factory()->count(2)->create();
        $ids = $users->pluck('id')->toArray();
        $response = $this->actingAs($user)->post(route('admin.users.bulk'), [
            'ids' => $ids,
            'action' => 'delete',
        ]);
        $response->assertStatus(403);
    }
}
