<?php

namespace Tests\Feature;

use App\Models\Reference;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReferenceFrontendTest extends TestCase
{
    use RefreshDatabase;

    public function test_references_page_displays_items()
    {
        Reference::factory()->create(['name' => 'Test Referans', 'is_active' => true]);
        $response = $this->get('/references');
        $response->assertStatus(200);
        $response->assertSee('Test Referans');
        // Türkçe yorum: Referans sayfasında eklenen referansın adı görüntüleniyor mu?
    }

    public function test_references_images_have_lazy_loading_and_alt()
    {
        $reference = Reference::factory()->create([
            'name' => 'SEO Referans',
            'is_active' => true,
            'images' => ['test1.jpg', 'test2.jpg'],
        ]);
        $response = $this->get('/references');
        $response->assertSee('alt="SEO Referans"', false);
        $response->assertSee('loading="lazy"', false);
        // Türkçe yorum: Referans görsellerinde alt attribute ve lazy loading var mı?
    }
} 