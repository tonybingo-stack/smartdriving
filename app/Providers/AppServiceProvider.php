<?php

namespace App\Providers;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\Sanctum;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Sanctum::ignoreMigrations();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::preventLazyLoading(app()->isLocal());
        Builder::macro('advancedFilter', function (
            array $columns = ['*'], 
        ) :LengthAwarePaginator {
            $request = request();
            /**
             * @var Builder $this
             */
            return $this->when($request->has('sortBy') && is_array($request->input('sortBy')), 
            function (Builder $query) use ($request) {
                $sortByParams = (array) $request->input('sortBy');
                foreach ($sortByParams as $param) {
                    $query->orderBy($param['key'], $param['order']);
                }
            },
            function (Builder $query) {
                $query->orderByDesc('id');
            })->paginate($request->input('itemsPerPage', 20), $columns, 'page');
        });
    }
}
