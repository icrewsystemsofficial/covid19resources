<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\ServiceProvider;

class DBConfigProvier extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $blacklisted_words = Setting::where('name', 'BLACKLISTED_KEYWORDS')->first();

        if($blacklisted_words) {
            config()->set(['app.blacklisted_words' => $blacklisted_words->value]);
        }
    }
}
