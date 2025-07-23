<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class AuthRegisterTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_register_with_valid_data()
    {
        $response = $this->post('/register', [
            'name' => 'Test Kullanıcı',
            'email' => 'test@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);
        $response->assertRedirect('/email/verify');
        $this->assertDatabaseHas('users', ['email' => 'test@example.com']);
        // Türkçe açıklama: Geçerli bilgilerle kayıt olan kullanıcı e-posta doğrulama sayfasına yönlendirilir.
    }

    public function test_register_fails_with_missing_fields()
    {
        $response = $this->post('/register', [
            'name' => '',
            'email' => '',
            'password' => '',
        ]);
        $response->assertSessionHasErrors(['name', 'email', 'password']);
        // Türkçe açıklama: Zorunlu alanlar eksik olduğunda kayıt işlemi başarısız olur ve hata mesajı döner.
    }

    public function test_register_fails_with_duplicate_email()
    {
        User::factory()->create(['email' => 'test@example.com']);
        $response = $this->post('/register', [
            'name' => 'Test Kullanıcı',
            'email' => 'test@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);
        $response->assertSessionHasErrors(['email']);
        // Türkçe açıklama: Aynı e-posta ile ikinci kez kayıt olmaya çalışıldığında hata döner.
    }
} 