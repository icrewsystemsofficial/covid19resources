<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Mail\ScoutUpdate;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Artisan;

class AlgoliaDataSync extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scout:send-updates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This re-indexes the current data to the Algolia server for the Tweets & Resources model';

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

        // $this->line('Flushing all the data in the database');
        // Artisan::call('scout:import "App\Models\Twitter"');
        // $this->info(Artisan::output());

        // $this->line('Preparing to import data...');


        // Artisan::call('scout:import "\\App\\Models\\Twitter"');
        // $output = Artisan::output();
        // $this->info($output);

        $this->line('Sending SCOUT (Algolia) updates to all admins');
        $users = User::role('superadmin')->get();
        foreach($users as $user) {
            $this->info('Mailing '.$user->name);
            Mail::to($user->email)->send(new ScoutUpdate($user->name));
        }

        $this->info('Done! Sent algolia updates to all admins');
    }
}
