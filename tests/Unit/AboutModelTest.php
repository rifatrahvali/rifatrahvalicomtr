<?php

namespace Tests\Unit;

use App\Models\About;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AboutModelTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function about_user_relationship_works()
    {
        $user = User::factory()->create();
        $about = About::factory()->create(['user_id' => $user->id]);
        $this->assertTrue($about->user->is($user));
        // Türkçe: Hakkımda ile kullanıcı ilişkisi doğru çalışıyor mu kontrol edilir.
    }

    /** @test */
    public function about_fillable_fields_are_assignable()
    {
        $about = About::factory()->make([
            'title' => 'Deneme Başlık',
            'description' => 'Açıklama metni',
            'cv_url' => 'cv.pdf',
            'order' => 1,
            'is_active' => true,
        ]);
        $this->assertEquals('Deneme Başlık', $about->title);
        $this->assertEquals('Açıklama metni', $about->description);
        $this->assertEquals('cv.pdf', $about->cv_url);
        $this->assertEquals(1, $about->order);
        $this->assertTrue($about->is_active);
        // Türkçe: Fillable alanlar doğru şekilde atanabiliyor mu kontrol edilir.
    }
} 