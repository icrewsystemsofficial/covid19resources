<?php

namespace App\Console\Commands;

use App\Models\Twitter;
use Illuminate\Console\Command;

class TwitterProcess extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'twitter:process';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process all the stored tweets';

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
        $tweets = Twitter::all();
        foreach($tweets as $tweet) {
            $this->line($tweet->id);
            $this->line($tweet->tweet);

        }
        $this->info('Done');
    }
}
