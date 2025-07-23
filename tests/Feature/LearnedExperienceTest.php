<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Experience;
use App\Models\LearnedExperience;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LearnedExperienceTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function kullanici_is_deneyimi_kazanim_ekleyebilir_ve_listeleyebilir()
    {
        $user = User::factory()->create();
        $experience = Experience::factory()->create(['user_id' => $user->id]);
        $this->actingAs($user);

        // Yeni kazanım ekle
        $response = $this->post(route('learned.experiences.store'), [
            'experience_id' => $experience->id,
            'description' => 'Takım çalışması becerisi',
            'activity_field' => 'Yazılım',
            'activity_tags' => ['takım', 'iletişim'],
        ]);
        $response->assertRedirect(route('learned.experiences.index'));
        $this->assertDatabaseHas('learned_experiences', [
            'experience_id' => $experience->id,
            'description' => 'Takım çalışması becerisi',
        ]);

        // Listeleme sayfası
        $response = $this->get(route('learned.experiences.index'));
        $response->assertSee('Takım çalışması becerisi');
        // Türkçe yorum: Kullanıcı yeni bir iş deneyimi kazanımı ekleyip listeleyebiliyor mu test edilir.
    }
} 