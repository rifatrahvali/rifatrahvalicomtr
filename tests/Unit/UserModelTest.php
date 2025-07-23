<?php

namespace Tests\Unit;

use App\Models\User;
use App\Models\UserProfile;
use App\Models\Experience;
use App\Models\Education;
use App\Models\Certificate;
use App\Models\About;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserModelTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_profile_relationship_works()
    {
        $user = User::factory()->create();
        $profile = UserProfile::factory()->create(['user_id' => $user->id]);
        $this->assertTrue($user->profile->is($profile));
        // Türkçe: Kullanıcı ile profil ilişkisi doğru çalışıyor mu kontrol edilir.
    }

    /** @test */
    public function user_experiences_relationship_works()
    {
        $user = User::factory()->create();
        $exp = Experience::factory()->create(['user_id' => $user->id]);
        $this->assertTrue($user->experiences->contains($exp));
        // Türkçe: Kullanıcı ile deneyim ilişkisi doğru çalışıyor mu kontrol edilir.
    }

    /** @test */
    public function user_educations_relationship_works()
    {
        $user = User::factory()->create();
        $edu = Education::factory()->create(['user_id' => $user->id]);
        $this->assertTrue($user->educations->contains($edu));
        // Türkçe: Kullanıcı ile eğitim ilişkisi doğru çalışıyor mu kontrol edilir.
    }

    /** @test */
    public function user_certificates_relationship_works()
    {
        $user = User::factory()->create();
        $cert = Certificate::factory()->create(['user_id' => $user->id]);
        $this->assertTrue($user->certificates->contains($cert));
        // Türkçe: Kullanıcı ile sertifika ilişkisi doğru çalışıyor mu kontrol edilir.
    }

    /** @test */
    public function user_about_relationship_works()
    {
        $user = User::factory()->create();
        $about = About::factory()->create(['user_id' => $user->id]);
        $this->assertTrue($user->about->is($about));
        // Türkçe: Kullanıcı ile hakkımda ilişkisi doğru çalışıyor mu kontrol edilir.
    }

    /** @test */
    public function user_password_is_hashed()
    {
        $user = User::factory()->create(['password' => 'secret123']);
        $this->assertNotEquals('secret123', $user->password);
        $this->assertTrue(password_verify('secret123', $user->password));
        // Türkçe: Kullanıcı şifresi hashlenmiş mi kontrol edilir.
    }
} 