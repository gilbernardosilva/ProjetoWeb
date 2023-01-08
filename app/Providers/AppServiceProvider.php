<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Platform;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

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
                $view->with('categories', Category::all())->with('platforms', Platform::all())->with('user', Auth::user());
            }
        );
    }
}
