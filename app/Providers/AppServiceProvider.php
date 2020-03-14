<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::Share('category', Category::query()->get());
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }
}
