<?php

namespace App\Providers;

use App\Models\Experience;
use App\Models\Education;
use App\Policies\ExperiencePolicy;
use App\Policies\EducationPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Experience::class => ExperiencePolicy::class,
        Education::class => EducationPolicy::class,
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
