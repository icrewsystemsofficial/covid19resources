<?php

namespace App\Providers;

use App\Models\States;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
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
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        if(Schema::hasTable('states')) {
            $currentlocation = \App\Http\Controllers\API\Location::locationDisplay();
            View::share('currentlocation', $currentlocation);
        }

        Paginator::useBootstrap();
    }
}
