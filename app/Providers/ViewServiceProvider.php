<?php

namespace App\Providers;

use App\View\Composers\MenuComposer;
use App\View\Composers\CustomerComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
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
        View::composer('admin.layouts.navigation', MenuComposer::class);
        View::composer('layouts.navigation', MenuComposer::class);
        View::composer('dashboard', CustomerComposer::class);
    }
}
