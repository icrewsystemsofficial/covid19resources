<?php

namespace App\Console\Commands;

use App\Models\Twitter;
use Illuminate\Console\Command;

class TwitterPurgeSpam extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'twitter:purge-spam {howmany=1000}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Purge spam tweets, default count: 1000';

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
    	$this->line('Deleting all Tweets marked as SPAM');
        $spam = Twitter::where('status', Twitter::SPAM)->limit($this->argument('howmany'))->get();
        if($spam->count() > 0) {
        	$this->line('Selected '.$spam->count().' spam tweets...deleting them');
	        $i = 0;
	        foreach($spam as $spam) {
	            $spam->delete();
	            $i++;
	            $this->line('Deleting ' . $i);
	        }
	        $this->info('Deleted: '.$i.' tweets, '.$spam->count().' SPAM tweets remaining');	
        } else {
        	$this->info('Yay! No spam tweets found');
        }

    }
}
