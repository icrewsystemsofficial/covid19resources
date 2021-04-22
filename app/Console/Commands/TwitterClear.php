<?php

namespace App\Console\Commands;

use App\Models\Twitter;
use Illuminate\Console\Command;

class TwitterClear extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'twitter:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete all the existing tweets in the database. Caution: Do this only if requried, the data that you will be deleting might not have been processed.';

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
        $total_tweets = Twitter::all()->count();
        $this->line('A total of '.$total_tweets.' tweets purged');
        // Twitter::truncate();
        $this->info('Data truncated');
    }
}
