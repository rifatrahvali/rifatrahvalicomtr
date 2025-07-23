<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\About;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AboutSectionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function kullanici_hakkimda_bolumu_ekleyebilir_ve_listeleyebilir()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        // Yeni hakkımda bölümü ekle
        $response = $this->post(route('abouts.store'), [
            'title' => 'Hakkımda Başlık',
            'description' => 'Detaylı açıklama',
            'order' => 1,
            'is_active' => true,
        ]);
        $response->assertRedirect(route('abouts.index'));
        $this->assertDatabaseHas('abouts', [
            'user_id' => $user->id,
            'title' => 'Hakkımda Başlık',
        ]);

        // Listeleme sayfası
        $response = $this->get(route('abouts.index'));
        $response->assertSee('Hakkımda Başlık');
        // Türkçe yorum: Kullanıcı yeni bir hakkımda bölümü ekleyip listeleyebiliyor mu test edilir.
    }
} 