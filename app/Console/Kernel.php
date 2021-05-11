<?php

namespace App\Console;

use App\Console\Commands\SendAdminMail;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        // SendAdminMail::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('send:tweetstats')->everyMinute();

        $schedule->command('queue:work --stop-when-empty')->description('Runs the queue-worker')->everyMinute();

        $schedule->command('twitter:screen 500')->description('Starts screening the tweets for blacklisted words')->everyFiveMinutes();
        $schedule->command('twitter:duplicates 500')->description('Marks the duplicated tweets')->everyFiveMinutes();
        $schedule->command('twitter:scan')->description('Restarts the TwitterScanner')->everyFifteenMinutes();
		$schedule->command('twitter:purge-spam')->description('Deletes all the spam tweets')->everyFiveMinutes();

        //$schedule->command('mission:assign')->everyFifteenMinutes();
        //$schedule->command('mission:remind')->everySixHours();
        //$schedule->command('mission:dissolve')->dailyAt('5:30');

        $schedule->command('scout:flush "App\Models\Twitter"')->hourlyAt(1);
        $schedule->command('scout:import "App\Models\Twitter"')->hourlyAt(3);
        $schedule->command('scout:send-updates')->hourlyAt(4);

        // $schedule->command('send:tweetstats')->dailyAt('21:00');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
