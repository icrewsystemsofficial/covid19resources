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
        $schedule->command('queue:work')->everyMinute();
        $schedule->command('twitter:scan')->everyFifteenMinutes();
        $schedule->command('twitter:screen 100')->everyMinute();
        $schedule->command('twitter:duplicates 100')->everyMinute();
        $schedule->command('mission:assign')->everyFifteenMinutes();
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
