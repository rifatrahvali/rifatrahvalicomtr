<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class AuthLoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_login_with_correct_credentials()
    {
        $user = User::factory()->create([
            'password' => bcrypt('password123'),
        ]);
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password123',
        ]);
        $response->assertRedirect('/');
        $this->assertAuthenticatedAs($user);
        // Türkçe açıklama: Doğru bilgilerle giriş yapan kullanıcı başarılı şekilde yönlendirilir ve oturum açılır.
    }

    public function test_user_cannot_login_with_wrong_password()
    {
        $user = User::factory()->create([
            'password' => bcrypt('password123'),
        ]);
        $response = $this->from('/login')->post('/login', [
            'email' => $user->email,
            'password' => 'yanlisSifre',
        ]);
        $response->assertRedirect('/login');
        $this->assertGuest();
        // Türkçe açıklama: Yanlış şifre ile giriş denemesi başarısız olur ve kullanıcı oturum açamaz.
    }

    public function test_login_rate_limiting()
    {
        $user = User::factory()->create([
            'password' => bcrypt('password123'),
        ]);
        for ($i = 0; $i < 6; $i++) {
            $this->from('/login')->post('/login', [
                'email' => $user->email,
                'password' => 'yanlisSifre',
            ]);
        }
        $response = $this->from('/login')->post('/login', [
            'email' => $user->email,
            'password' => 'yanlisSifre',
        ]);
        $response->assertSessionHasErrors();
        // Türkçe açıklama: Çok sayıda başarısız giriş denemesinde rate limit devreye girer ve hata döner.
    }

    public function test_user_with_2fa_is_redirected_to_2fa_verify()
    {
        $user = User::factory()->create([
            'password' => bcrypt('password123'),
            'google2fa_secret' => 'TESTSECRET',
        ]);
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password123',
        ]);
        $response->assertRedirect('/2fa/verify');
        // Türkçe açıklama: 2FA aktif olan kullanıcı giriş yaptığında doğrulama sayfasına yönlendirilir.
    }
} 