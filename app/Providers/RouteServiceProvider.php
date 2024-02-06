<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/dashboard';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->name('api.')
                ->group(base_path('routes/api.php'));

            Route::middleware(['web', 'auth:sanctum', 'admin'])
                ->prefix('admin')
                ->name('admin.')
                ->group(base_path('routes/admin.php'));

            Route::middleware(['web', 'auth:sanctum', 'instructor'])
                ->prefix('instructor')
                ->name('instructor.')
                ->group(base_path('routes/instructor.php'));

            Route::middleware(['web', 'auth:sanctum', 'mechanic'])
                ->prefix('mechanic')
                ->name('mechanic.')
                ->group(base_path('routes/mechanic.php'));

            Route::middleware(['web', 'auth:sanctum', 'reseller'])
                ->prefix('reseller')
                ->name('reseller.')
                ->group(base_path('routes/reseller.php'));

            Route::middleware(['web', 'auth:sanctum'])
                ->group(base_path('routes/web.php'));
            
            Route::middleware(['web'])
                ->group(base_path('routes/guest.php'));

        });
    }
}
