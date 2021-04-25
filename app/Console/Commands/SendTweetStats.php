<?php

namespace App\Console\Commands;

use App\Jobs\SendStaticsJob;
use App\Models\User;
use Illuminate\Console\Command;

class SendTweetStats extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:tweetstats';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends the  Tweet stats to super admin daily at 21:00';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = User::role('1')->get();

       foreach ($users as $user) {
           
            $details = [
                'to' => $user->email
            ];
            SendStaticsJob::dispatch($details)->delay(now()->addSeconds(5));
         }
        $this->info('Statistics successfully sent to admins');
    }
}
