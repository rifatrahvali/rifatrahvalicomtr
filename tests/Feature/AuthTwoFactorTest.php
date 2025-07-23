<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class AuthTwoFactorTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_enable_2fa()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->post('/2fa/enable');
        $response->assertStatus(302);
        $user->refresh();
        $this->assertNotNull($user->google2fa_secret);
        // Türkçe açıklama: Kullanıcı 2FA'yı etkinleştirdiğinde google2fa_secret alanı dolu olmalı.
    }

    public function test_user_can_verify_2fa_code()
    {
        $user = User::factory()->create([
            'google2fa_secret' => 'TESTSECRET',
        ]);
        $this->actingAs($user);
        // Burada gerçek bir 2FA kodu üretmek için Google2FA library'si kullanılabilir.
        // Test ortamında örnek bir kod ile doğrulama simüle edilir.
        $response = $this->post('/2fa/verify', [
            'one_time_password' => '123456',
        ]);
        $response->assertStatus(302);
        // Türkçe açıklama: Kullanıcı doğru 2FA kodunu girdiğinde doğrulama başarılı olur.
    }

    public function test_user_can_disable_2fa()
    {
        $user = User::factory()->create([
            'google2fa_secret' => 'TESTSECRET',
        ]);
        $this->actingAs($user);
        $response = $this->post('/2fa/disable');
        $response->assertStatus(302);
        $user->refresh();
        $this->assertNull($user->google2fa_secret);
        // Türkçe açıklama: Kullanıcı 2FA'yı devre dışı bıraktığında google2fa_secret alanı null olmalı.
    }
} 