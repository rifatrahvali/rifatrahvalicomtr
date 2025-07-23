<?php

namespace Tests\Unit;

use App\Models\Experience;
use App\Models\User;
use App\Models\Skill;
use App\Models\LearnedExperience;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExperienceModelTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function experience_user_relationship_works()
    {
        $user = User::factory()->create();
        $exp = Experience::factory()->create(['user_id' => $user->id]);
        $this->assertTrue($exp->user->is($user));
        // Türkçe: Deneyim ile kullanıcı ilişkisi doğru çalışıyor mu kontrol edilir.
    }

    /** @test */
    public function experience_skills_relationship_works()
    {
        $exp = Experience::factory()->create();
        $skill = Skill::factory()->create();
        $exp->skills()->attach($skill->id);
        $this->assertTrue($exp->skills->contains($skill));
        // Türkçe: Deneyim ile beceri ilişkisi doğru çalışıyor mu kontrol edilir.
    }

    /** @test */
    public function experience_learned_experiences_relationship_works()
    {
        $exp = Experience::factory()->create();
        $learned = LearnedExperience::factory()->create(['experience_id' => $exp->id]);
        $this->assertTrue($exp->learnedExperiences->contains($learned));
        // Türkçe: Deneyim ile kazanımlar ilişkisi doğru çalışıyor mu kontrol edilir.
    }

    /** @test */
    public function experience_dates_are_cast_to_date()
    {
        $exp = Experience::factory()->create([
            'start_date' => '2020-01-01',
            'end_date' => '2021-01-01',
        ]);
        $this->assertInstanceOf(\Illuminate\Support\Carbon::class, $exp->start_date);
        $this->assertInstanceOf(\Illuminate\Support\Carbon::class, $exp->end_date);
        // Türkçe: Tarih alanları doğru şekilde Carbon nesnesine cast ediliyor mu kontrol edilir.
    }
} 