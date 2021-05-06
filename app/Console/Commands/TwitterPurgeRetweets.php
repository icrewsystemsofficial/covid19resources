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
    protected $signature = 'twitter:purge-rt {howmany=1000}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Purge re-tweets, default count: 1000';

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
        $this->line('Deleting all the duplicated tweets (re-tweets)');
        $spam = Twitter::where('status', Twitter::RETWEET)->limit($this->argument('howmany'))->get();
        if($spam->count() > 0) {
        	$this->line('Selected '.$spam->count().' duplicated tweets...deleting them');
	        $i = 0;
	        foreach($spam as $spam) {
	            $spam->delete();
	            $i++;
	            $this->line('Deleting ' . $i);
	        }
	        $this->info('Deleted: '.$i.' tweets, '.$spam->count().' RETWEETS tweets remaining');	
        } else {
        	$this->info('Yay! No duplicate tweets found');
        }

    }
}
