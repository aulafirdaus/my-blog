<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Blade;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        'App\Models\Article' => 'App\Policies\ArticlePolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        // Gate::define('is_admin', fn ($user) => $user->isAdmin() ? true : null);
        Gate::before(fn ($user, $ability) => $user->isAdmin() ? true : null);

        Blade::directive('hasAnyRoles', fn ($roles) => "<?php if (auth()->user()->hasAnyRoles({$roles})): ?>");
        Blade::directive('endHasAnyRoles', fn () => "<?php endif ?>");
        Blade::directive('hasRole', fn ($role) => "<?php if (auth()->user()->hasRole($role)): ?>");
        Blade::directive('endHasRole', fn () => "<?php endif ?>");
    }
}
