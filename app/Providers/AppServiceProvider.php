<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Platform;
use App\Models\Category;

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
        view()->composer(
            'partials.navbar',
            function ($view) {
                $view->with('categories', Category::all())->with('platforms', Platform::all());
            }
        );
    }
}
