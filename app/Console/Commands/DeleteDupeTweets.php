<?php

namespace App\Console\Commands;

use App\Models\Twitter;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class DeleteDupeTweets extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'twitter:dupdelete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command searches for duplicate tweets and deletes them';

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

        // Get all the duplicates 
       $tweets = Twitter::where('status', Twitter::SCREENED)->get();
       $twitterUnique = $tweets->unique(['tweet_id']);
       $twitterDuplicates = $tweets->diff($twitterUnique);
       
        // Loops through all the duplicates and keeps only one and delete other tweets
       if(count($twitterDuplicates) < 1) {

           $this->info('Good Job! No duplicate tweets found');

       } else {

           $this->line('Found '.count($twitterDuplicates).' duplicates, deleting them...');

           foreach($twitterDuplicates as $dupes) {
               $this->line('Deleting tweet '.$dupes->tweet_id.'. (ID # '.$dupes->id.' )');
               $dupes->delete();
            }
            $this->line('Success! Deleted '.count($twitterDuplicates).' duplicate tweets');
       }





         // $duptweets = DB::table('twitters')
        // ->select('tweet_id', DB::raw('count(`tweet_id`) as occurences'))
        // ->groupBy('tweet_id')
        // ->having('occurences', '>', 1)
        // ->get();
         // dd($duptweets);

    }

}
