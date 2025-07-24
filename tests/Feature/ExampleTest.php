<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_csrf_protection_blocks_post_without_token()
    {
        // Türkçe: CSRF token olmadan POST isteği yapılırsa 419 döner
        $response = $this->post('/blog');
        $response->assertStatus(419);
        // Türkçe: CSRF koruması aktif ve token olmadan işlem engelleniyor
    }
}
