<?php

namespace Tests\Unit;

use App\Models\Gallery;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GalleryModelTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function gallery_fillable_fields_are_assignable()
    {
        $gallery = Gallery::factory()->make([
            'title' => 'Galeri Başlık',
            'description' => 'Açıklama',
            'path' => 'uploads/test.jpg',
            'type' => 'image',
            'order' => 2,
            'alt_text' => 'Alternatif metin',
        ]);
        $this->assertEquals('Galeri Başlık', $gallery->title);
        $this->assertEquals('Açıklama', $gallery->description);
        $this->assertEquals('uploads/test.jpg', $gallery->path);
        $this->assertEquals('image', $gallery->type);
        $this->assertEquals(2, $gallery->order);
        $this->assertEquals('Alternatif metin', $gallery->alt_text);
        // Türkçe: Fillable alanlar doğru şekilde atanabiliyor mu kontrol edilir.
    }
} 