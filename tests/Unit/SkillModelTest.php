<?php

namespace Tests\Unit;

use App\Models\Skill;
use App\Models\Experience;
use App\Models\Education;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SkillModelTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function skill_fillable_field_is_assignable()
    {
        $skill = Skill::factory()->make(['name' => 'PHP']);
        $this->assertEquals('PHP', $skill->name);
        // Türkçe: Fillable alan (name) doğru şekilde atanabiliyor mu kontrol edilir.
    }

    /** @test */
    public function skill_experiences_polymorphic_relationship_works()
    {
        $skill = Skill::factory()->create();
        $exp = Experience::factory()->create();
        $skill->experiences()->attach($exp->id);
        $this->assertTrue($skill->experiences->contains($exp));
        // Türkçe: Skill ile deneyim arasındaki polimorfik ilişki doğru çalışıyor mu kontrol edilir.
    }

    /** @test */
    public function skill_educations_polymorphic_relationship_works()
    {
        $skill = Skill::factory()->create();
        $edu = Education::factory()->create();
        $skill->educations()->attach($edu->id);
        $this->assertTrue($skill->educations->contains($edu));
        // Türkçe: Skill ile eğitim arasındaki polimorfik ilişki doğru çalışıyor mu kontrol edilir.
    }
} 