<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // register repository
        $this->app->bind(
            'App\Repositories\CompanyRepository\CompanyRepositoryInterface',
            'App\Repositories\CompanyRepository\CompanyRepository',
        );
        $this->app->bind(
            'App\Repositories\MediaRepository\MediaRepositoryInterface',
            'App\Repositories\MediaRepository\MediaRepository',
        );
        $this->app->bind(
            'App\Repositories\JobRepository\JobRepositoryInterface',
            'App\Repositories\JobRepository\JobRepository',
        );
        $this->app->bind(
            'App\Repositories\StoreRepository\StoreRepositoryInterface',
            'App\Repositories\StoreRepository\StoreRepository',
        );
        $this->app->bind(
            'App\Repositories\CategoryRepository\CategoryRepositoryInterface',
            'App\Repositories\CategoryRepository\CategoryRepository',
        );
        $this->app->bind(
            'App\Repositories\SkillRepository\SkillRepositoryInterface',
            'App\Repositories\SkillRepository\SkillRepository',
        );
        $this->app->bind(
            'App\Repositories\OccupationRepository\OccupationRepositoryInterface',
            'App\Repositories\OccupationRepository\OccupationRepository',
        );
        $this->app->bind(
            'App\Repositories\StationRepository\StationRepositoryInterface',
            'App\Repositories\StationRepository\StationRepository',
        );
        $this->app->bind(
            'App\Repositories\WorkerRepository\WorkerRepositoryInterface',
            'App\Repositories\WorkerRepository\WorkerRepository',
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
//        Paginator::defaultView();
//        Paginator::defaultSimpleView();
    }
}
