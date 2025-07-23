<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Skill;

class CVSkillManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_skill()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->post('/skills', [
            'name' => 'PHP',
        ]);
        $response->assertStatus(302);
        $this->assertDatabaseHas('skills', ['name' => 'PHP']);
        // Türkçe açıklama: Kullanıcı yeni bir beceri ekleyebilmeli.
    }

    public function test_user_can_update_skill()
    {
        $user = User::factory()->create();
        $skill = \App\Models\Skill::factory()->create(['name' => 'Eski Beceri']);
        $this->actingAs($user);
        $response = $this->put('/skills/' . $skill->id, [
            'name' => 'Laravel',
        ]);
        $response->assertStatus(302);
        $skill->refresh();
        $this->assertEquals('Laravel', $skill->name);
        // Türkçe açıklama: Kullanıcı becerisini başarıyla güncelleyebilmeli.
    }

    public function test_user_can_delete_skill()
    {
        $user = User::factory()->create();
        $skill = \App\Models\Skill::factory()->create(['name' => 'Silinecek Beceri']);
        $this->actingAs($user);
        $response = $this->delete('/skills/' . $skill->id);
        $response->assertStatus(302);
        $this->assertDatabaseMissing('skills', ['id' => $skill->id]);
        // Türkçe açıklama: Kullanıcı becerisini silebilmeli.
    }

    public function test_guest_cannot_create_skill()
    {
        $response = $this->post('/skills', [
            'name' => 'PHP',
        ]);
        $response->assertRedirect('/login');
        // Türkçe açıklama: Giriş yapmamış kullanıcı beceri ekleyemez.
    }
} 