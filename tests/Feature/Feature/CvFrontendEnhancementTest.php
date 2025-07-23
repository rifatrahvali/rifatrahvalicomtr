<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\UserProfile;
use App\Models\Experience;
use App\Models\Education;
use App\Models\Certificate;
use App\Models\Skill;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CvFrontendEnhancementTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        config(['app.locale' => 'tr']);
    }

    /** @test */
    public function timeline_ve_skill_chart_gorunur()
    {
        $user = User::factory()->create();
        UserProfile::factory()->create(['user_id' => $user->id]);
        Experience::factory()->create(['user_id' => $user->id, 'title' => 'Deneyim 1']);
        Education::factory()->create([
            'user_id' => $user->id,
            'school' => 'Üniversite 1',
            'degree' => 'Lisans',
            'field_of_study' => 'Bilgisayar Mühendisliği',
            'start_date' => '2010',
            'end_date' => '2014',
            'description' => 'Açıklama',
        ]);
        $skill = Skill::factory()->create(['name' => 'PHP']);
        $user->skills()->attach($skill->id);
        $response = $this->get('/cv');
        $response->assertSeeText('İş Deneyimleri');
        $response->assertSeeText('Deneyim 1');
        $response->assertSeeText('Eğitimler');
        $response->assertSeeText('Üniversite 1');
        $response->assertSee('timeline');
        $response->assertSee('skillChart');
        // Türkçe: Timeline ve skill chart alanları doğru şekilde render ediliyor mu kontrol edilir
    }

    /** @test */
    public function sertifika_grid_ve_hover_gorunur()
    {
        $user = User::factory()->create();
        UserProfile::factory()->create(['user_id' => $user->id]);
        Certificate::factory()->create([
            'user_id' => $user->id,
            'name' => 'Sertifika 1',
            'issuing_organization' => 'Kurum',
            'issue_date' => '2020-01-01',
            'credential_url' => 'https://example.com',
            // Türkçe: Migrationda description alanı yok, eklenmedi.
        ]);
        $response = $this->get('/cv');
        $response->assertSeeText('Sertifikalar');
        $response->assertSeeText('Sertifika 1');
        $response->assertSee('certificate-grid');
        $response->assertSee('certificate-card');
        // Türkçe: Sertifika grid ve hover alanı doğru şekilde render ediliyor mu kontrol edilir
    }

    /** @test */
    public function pdf_print_butonu_gorunur()
    {
        $user = User::factory()->create();
        UserProfile::factory()->create(['user_id' => $user->id]);
        $response = $this->get('/cv');
        $response->assertSeeText('PDF/Çıktı Al');
        // Türkçe: PDF/print butonu doğru şekilde render ediliyor mu kontrol edilir
    }
}
