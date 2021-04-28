<?php

namespace App\Console\Commands;

use App\Models\Twitter;
use Illuminate\Console\Command;

class TwitterPurgeRetweets extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'twitter:purge-rt';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Purge all the re-tweets';

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
        $this->line('Deleting all Tweets marked as spam');
        $spam = Twitter::where('status', Twitter::RETWEET)->limit(1000)->get();
        foreach($spam as $spam) {
            $spam->delete();
        }

        $this->line($spam->count().' tweets marked as "SPAM" were deleted.');
    }
}
