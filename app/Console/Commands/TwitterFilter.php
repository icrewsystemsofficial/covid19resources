<?php

namespace App\Console\Commands;

use App\Models\Twitter;
use Illuminate\Console\Command;

class TwitterFilter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'twitter:screen {howmany=50}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Screen all the fresh tweets and filter those who have blacklisted words in them';

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
        $tweets = Twitter::where('status', Twitter::PENDING)
            ->orderBy('created_at')
            ->limit($this->argument('howmany'))
            ->get();

        $this->info('Filtering ' . $this->argument('howmany') .' tweets');

        $filtered = 0;
        foreach($tweets as $tweet) {
            $filterTweet = $tweet->filterTweet();
                if($filterTweet['type'] != 'ok') {
                    $this->info($filterTweet['message']);
                    // $tweet->status = Twitter::SPAM;
                    $tweet->delete();
                } else {
                    $this->line($filterTweet['message']);
                    $tweet->status = Twitter::SCREENED;
                    $tweet->update();
                }

            $filtered = $filtered + 1;
        }

        if($filtered == 0) {
            $this->info('Good Job! There are no tweets pending for screening');
        } else {
            $this->info('Success! Filtered '.$filtered. '/' . $this->argument('howmany') .' tweets');
        }
    }
}
