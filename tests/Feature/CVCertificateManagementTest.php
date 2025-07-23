<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Certificate;

class CVCertificateManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_certificate()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->post('/certificates', [
            'name' => 'Sertifika',
            'issuing_organization' => 'Kurum',
            'issue_date' => '2022-01-01',
        ]);
        $response->assertStatus(302);
        $this->assertDatabaseHas('certificates', ['name' => 'Sertifika']);
        // Türkçe açıklama: Kullanıcı yeni bir sertifika ekleyebilmeli.
    }

    public function test_user_can_update_certificate()
    {
        $user = User::factory()->create();
        $certificate = Certificate::factory()->create(['user_id' => $user->id]);
        $this->actingAs($user);
        $response = $this->put('/certificates/' . $certificate->id, [
            'name' => 'Güncellenmiş Sertifika',
            'issuing_organization' => $certificate->issuing_organization,
            'issue_date' => $certificate->issue_date,
        ]);
        $response->assertStatus(302);
        $certificate->refresh();
        $this->assertEquals('Güncellenmiş Sertifika', $certificate->name);
        // Türkçe açıklama: Kullanıcı sertifikasını başarıyla güncelleyebilmeli.
    }

    public function test_user_can_delete_certificate()
    {
        $user = User::factory()->create();
        $certificate = Certificate::factory()->create(['user_id' => $user->id]);
        $this->actingAs($user);
        $response = $this->delete('/certificates/' . $certificate->id);
        $response->assertStatus(302);
        $this->assertDatabaseMissing('certificates', ['id' => $certificate->id]);
        // Türkçe açıklama: Kullanıcı sertifikasını silebilmeli.
    }

    public function test_guest_cannot_create_certificate()
    {
        $response = $this->post('/certificates', [
            'name' => 'Sertifika',
            'issuing_organization' => 'Kurum',
            'issue_date' => '2022-01-01',
        ]);
        $response->assertRedirect('/login');
        // Türkçe açıklama: Giriş yapmamış kullanıcı sertifika ekleyemez.
    }
} 