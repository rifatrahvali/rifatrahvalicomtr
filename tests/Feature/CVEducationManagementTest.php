<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Education;

class CVEducationManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_education()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->post('/educations', [
            'school' => 'Üniversite',
            'degree' => 'Lisans',
            'field_of_study' => 'Bilgisayar Mühendisliği', // Türkçe: Zorunlu alan eklendi.
            'description' => 'Açıklama', // Türkçe: İsteğe bağlı alan eklendi.
            'start_date' => '2018-09-01',
            'end_date' => '2022-06-01',
        ]);
        $response->assertStatus(302);
        $this->assertDatabaseHas('educations', ['school' => 'Üniversite']);
        // Türkçe açıklama: Kullanıcı yeni bir eğitim bilgisi ekleyebilmeli.
    }

    public function test_user_can_update_education()
    {
        $user = User::factory()->create();
        $education = Education::factory()->create(['user_id' => $user->id]);
        $this->actingAs($user);
        $response = $this->put('/educations/' . $education->id, [
            'school' => 'Güncellenmiş Okul',
            'degree' => $education->degree,
            'field_of_study' => $education->field_of_study,
            'description' => $education->description,
            'start_date' => $education->start_date,
            'end_date' => $education->end_date,
        ]);
        $response->assertStatus(302);
        $education->refresh();
        $this->assertEquals('Güncellenmiş Okul', $education->school);
        // Türkçe açıklama: Kullanıcı eğitim bilgisini başarıyla güncelleyebilmeli.
    }

    public function test_user_can_delete_education()
    {
        $user = User::factory()->create();
        $education = Education::factory()->create(['user_id' => $user->id]);
        $this->actingAs($user);
        $response = $this->delete('/educations/' . $education->id);
        $response->assertStatus(302);
        $this->assertDatabaseMissing('educations', ['id' => $education->id]);
        // Türkçe açıklama: Kullanıcı eğitim bilgisini silebilmeli.
    }

    public function test_guest_cannot_create_education()
    {
        $response = $this->post('/educations', [
            'school' => 'Üniversite',
            'degree' => 'Lisans',
            'start_date' => '2018-09-01',
            'end_date' => '2022-06-01',
        ]);
        $response->assertRedirect('/login');
        // Türkçe açıklama: Giriş yapmamış kullanıcı eğitim ekleyemez.
    }
} 