<?php

namespace Tests\Unit;

use App\Models\Reference;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReferenceModelTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function reference_fillable_fields_are_assignable()
    {
        $reference = Reference::factory()->make([
            'name' => 'Referans Adı',
            'images' => ['img1.jpg', 'img2.jpg'],
            'website_url' => 'https://example.com',
            'description' => 'Açıklama',
            'company_name' => 'Şirket',
            'position' => 'Pozisyon',
            'order_index' => 3,
            'is_active' => true,
        ]);
        $this->assertEquals('Referans Adı', $reference->name);
        $this->assertEquals(['img1.jpg', 'img2.jpg'], $reference->images);
        $this->assertEquals('https://example.com', $reference->website_url);
        $this->assertEquals('Açıklama', $reference->description);
        $this->assertEquals('Şirket', $reference->company_name);
        $this->assertEquals('Pozisyon', $reference->position);
        $this->assertEquals(3, $reference->order_index);
        $this->assertTrue($reference->is_active);
        // Türkçe: Fillable alanlar ve images cast işlemi doğru çalışıyor mu kontrol edilir.
    }
} 