<?php

namespace App\Providers;

use App\models\Role;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Blade;

class PermissionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        try {
            Role::get()->map(function ($role) {
                Gate::define($role->slug, function ($user) use ($role) {
                    return $user->hasRole($role);
                });
            });
        } catch (\Exception $e) {
            report($e);
            return false;
        }

        //Blade directives
        Blade::directive('role', function ($role) {
            return "<?php if(auth()->check() && auth()->user()->hasRole($role)) : ?>"; //return this if statement inside php tag
        });

        Blade::directive('endrole', function ($role) {
            return "<?php endif; ?>"; //return this endif statement inside php tag
        });
    }
}
