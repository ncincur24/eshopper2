<?php

namespace App\Providers;

use App\Models\Brand;
use App\Models\Nav;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $nav = new Nav();
        View::share("nav", $nav->clientNav());
        View::share("brandsNav", Brand::all());
        Paginator::useBootstrap();
    }
}
