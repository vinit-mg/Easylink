<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Models\Customers;
use App\Models\CustomerSubscriptions;
use App\Models\Stores;

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

        // Custom binding for UUID column (not the primary key)
        Route::bind('customer', function ($value) {
            return Customers::where('uuid', $value)->firstOrFail(); // Ensure 'uuid' is used here
        });
        // Route::bind('subscription', function ($value) {
        //     return CustomerSubscriptions::where('id', $value)->firstOrFail(); // Ensure 'uuid' is used here
        // });

        Route::bind('store', function ($value) {
            return Stores::where('uuid', $value)->firstOrFail(); // Ensure 'uuid' is used here
        });
        
    }
}
