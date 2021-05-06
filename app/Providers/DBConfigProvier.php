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

        // $settings = Setting::all();

        // $setting_data = array();

        // foreach($settings as $setting) {
        //     $setting_data[$setting->name] = $setting->value;
        // }

        // config()->set(['app.name' => $setting_data['APP_NAME']]);

      /*  $max_tweets_per_mission = Setting::select('name', 'value')->where('name', 'MAX_TWEETS_TO_ASSIGN_IN_A_MISSION')->first();
        if($max_tweets_per_mission) {
            config()->set(['app.max_tweets_to_assign_in_a_mission' => $max_tweets_per_mission->value]);
        }

        $blacklisted_words = Setting::where('name', 'BLACKLISTED_KEYWORDS')->first();
        if($blacklisted_words) {
            config()->set(['app.blacklisted_words' => $blacklisted_words->value]);
        }*/
    }
}
