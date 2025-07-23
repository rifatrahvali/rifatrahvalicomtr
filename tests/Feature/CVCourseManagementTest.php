<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Course;

class CVCourseManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_course()
    {
        $user = \App\Models\User::factory()->create();
        $this->actingAs($user);
        $response = $this->post('/courses', [
            'name' => 'Kurs',
            'organization' => 'Kurum',
            'completion_date' => '2022-02-01', // Türkçe: start_date ve end_date yerine completion_date kullanıldı.
        ]);
        $response->assertStatus(302);
        $this->assertDatabaseHas('courses', ['name' => 'Kurs']);
        // Türkçe açıklama: Kullanıcı yeni bir kurs ekleyebilmeli.
    }

    public function test_user_can_update_course()
    {
        $user = \App\Models\User::factory()->create();
        $course = \App\Models\Course::factory()->create(['user_id' => $user->id]);
        $this->actingAs($user);
        $response = $this->put('/courses/' . $course->id, [
            'name' => 'Güncellenmiş Kurs',
            'organization' => $course->organization,
            'completion_date' => $course->completion_date->format('Y-m-d'),
        ]);
        $response->assertStatus(302);
        $course->refresh();
        $this->assertEquals('Güncellenmiş Kurs', $course->name);
        // Türkçe açıklama: Kullanıcı kursunu başarıyla güncelleyebilmeli.
    }

    public function test_user_can_delete_course()
    {
        $user = User::factory()->create();
        $course = Course::factory()->create(['user_id' => $user->id]);
        $this->actingAs($user);
        $response = $this->delete('/courses/' . $course->id);
        $response->assertStatus(302);
        $this->assertDatabaseMissing('courses', ['id' => $course->id]);
        // Türkçe açıklama: Kullanıcı kursunu silebilmeli.
    }

    public function test_guest_cannot_create_course()
    {
        $response = $this->post('/courses', [
            'name' => 'Kurs',
            'organization' => 'Kurum',
            'start_date' => '2022-01-01',
            'end_date' => '2022-02-01',
        ]);
        $response->assertRedirect('/login');
        // Türkçe açıklama: Giriş yapmamış kullanıcı kurs ekleyemez.
    }
} 