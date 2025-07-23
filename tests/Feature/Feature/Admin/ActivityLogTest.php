<?php

namespace Tests\Feature\Admin;

use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Spatie\Permission\Models\Role;

class ActivityLogTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function admin_log_kaydi_olusturabilir()
    {
        // Türkçe: Admin rolü yoksa oluştur
        if (!Role::where('name', 'admin')->exists()) {
            Role::create(['name' => 'admin']);
        }
        $admin = User::factory()->create();
        $admin->assignRole('admin');
        // Türkçe: Log kaydı oluşturuluyor
        $log = ActivityLog::log('test_action', 'Test açıklama', $admin->id, '127.0.0.1', 'TestAgent');
        $this->assertDatabaseHas('activity_logs', [
            'action' => 'test_action',
            'description' => 'Test açıklama',
            'user_id' => $admin->id,
        ]);
    }

    /** @test */
    public function admin_loglari_gorebilir()
    {
        // Türkçe: Admin rolü yoksa oluştur
        if (!Role::where('name', 'admin')->exists()) {
            Role::create(['name' => 'admin']);
        }
        $admin = User::factory()->create();
        $admin->assignRole('admin');
        ActivityLog::log('test_action', 'Test açıklama', $admin->id, '127.0.0.1', 'TestAgent');
        $response = $this->actingAs($admin)->get(route('admin.activity.index'));
        $response->assertStatus(200);
        $response->assertSee('Admin İşlem Logları');
        $response->assertSee('test_action');
    }

    /** @test */
    public function admin_olmayan_erisim_engellenir()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get(route('admin.activity.index'));
        $response->assertStatus(403);
    }
}
