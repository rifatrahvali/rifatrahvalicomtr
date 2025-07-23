<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Experience;

class CVExperienceManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_experience()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->post('/experiences', [
            'title' => 'Deneyim Başlığı',
            'company' => 'Şirket',
            'employment_type' => 'Tam Zamanlı', // Türkçe: Zorunlu alan eklendi.
            'location' => 'İstanbul', // Türkçe: İsteğe bağlı alan eklendi.
            'description' => 'Açıklama', // Türkçe: İsteğe bağlı alan eklendi.
            'start_date' => '2020-01-01',
            'end_date' => '2021-01-01',
        ]);
        $response->assertStatus(302);
        $this->assertDatabaseHas('experiences', ['title' => 'Deneyim Başlığı']);
        // Türkçe açıklama: Kullanıcı yeni bir iş deneyimi ekleyebilmeli.
    }

    public function test_user_can_update_experience()
    {
        $user = User::factory()->create();
        $experience = Experience::factory()->create(['user_id' => $user->id]);
        $this->actingAs($user);
        $response = $this->put('/experiences/' . $experience->id, [
            'title' => 'Güncellenmiş Deneyim',
            'company' => $experience->company,
            'employment_type' => $experience->employment_type,
            'location' => $experience->location,
            'description' => $experience->description,
            'start_date' => $experience->start_date,
            'end_date' => $experience->end_date,
        ]);
        $response->assertStatus(302);
        $experience->refresh();
        $this->assertEquals('Güncellenmiş Deneyim', $experience->title);
        // Türkçe açıklama: Kullanıcı deneyimini başarıyla güncelleyebilmeli.
    }

    public function test_user_can_delete_experience()
    {
        $user = User::factory()->create();
        $experience = Experience::factory()->create(['user_id' => $user->id]);
        $this->actingAs($user);
        $response = $this->delete('/experiences/' . $experience->id);
        $response->assertStatus(302);
        $this->assertDatabaseMissing('experiences', ['id' => $experience->id]);
        // Türkçe açıklama: Kullanıcı deneyimini silebilmeli.
    }

    public function test_guest_cannot_create_experience()
    {
        $response = $this->post('/experiences', [
            'title' => 'Deneyim Başlığı',
            'company' => 'Şirket',
            'start_date' => '2020-01-01',
            'end_date' => '2021-01-01',
        ]);
        $response->assertRedirect('/login');
        // Türkçe açıklama: Giriş yapmamış kullanıcı deneyim ekleyemez.
    }
} 