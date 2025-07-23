<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\UserProfile;

class CVProfileManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_view_own_profile()
    {
        $user = User::factory()->create();
        $profile = UserProfile::factory()->create(['user_id' => $user->id]);
        $response = $this->actingAs($user)->get('/profile');
        $response->assertStatus(200);
        $response->assertSee($profile->name);
        // Türkçe açıklama: Kullanıcı kendi profilini görüntüleyebilmeli.
    }

    public function test_user_can_update_profile()
    {
        $user = User::factory()->create();
        // $profile = UserProfile::factory()->create(['user_id' => $user->id]); // Türkçe: UserProfile factory ile oluşturulması kaldırıldı.
        $response = $this->actingAs($user)->put('/profile', [
            'first_name' => 'Yeni',
            'last_name' => 'İsim',
            'email' => $user->email,
            'title' => 'Test Başlık',
            'phone' => '',
            'website' => '',
            'address' => '',
        ]);
        $response->assertStatus(302);
        $user = $user->fresh();
        $this->assertNotNull($user->profile); // Türkçe: UserProfile'ın gerçekten oluştuğu kontrol edildi.
        $this->assertEquals('Yeni', $user->profile->first_name);
        // Türkçe açıklama: Kullanıcı profilini başarıyla güncelleyebilmeli.
    }

    public function test_guest_cannot_access_profile_page()
    {
        $response = $this->get('/profile');
        $response->assertRedirect('/login');
        // Türkçe açıklama: Giriş yapmamış kullanıcı profil sayfasına erişemez.
    }
} 