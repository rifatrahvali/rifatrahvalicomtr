<?php

namespace App\Providers;

use App\Models\Experience;
use App\Models\Education;
use App\Policies\ExperiencePolicy;
use App\Policies\EducationPolicy;
use App\Models\Certificate;
use App\Policies\CertificatePolicy;
use App\Models\Course;
use App\Policies\CoursePolicy;
use App\Models\About;
use App\Policies\AboutPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        About::class => AboutPolicy::class, // Türkçe yorum: About modeline AboutPolicy bağlandı
        Experience::class => ExperiencePolicy::class,
        Education::class => EducationPolicy::class,
                Certificate::class => CertificatePolicy::class,
        Course::class => CoursePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        //
    }
}
