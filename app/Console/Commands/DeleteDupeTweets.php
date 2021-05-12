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
       $tweets = Twitter::all();
       $twitterUnique = $tweets->unique(['tweet_id']);
       $twitterDuplicates = $tweets->diff($twitterUnique);
       
        // Loops through all the duplicates and keeps only one and delete other tweets
       if(count($twitterDuplicates) < 1) {

           $this->info('NO Duplicate tweets found');

       } else {

           $this->info('Found '.count($twitterDuplicates).' Duplicates');

           foreach($twitterDuplicates as $dupes) {
               $this->info('Deleting Tweet with tweet id '.$dupes->tweet_id);
               $dupes->delete();
            }
            $this->info('Success! All the duplicates deleted');
       }





         // $duptweets = DB::table('twitters')
        // ->select('tweet_id', DB::raw('count(`tweet_id`) as occurences'))
        // ->groupBy('tweet_id')
        // ->having('occurences', '>', 1)
        // ->get();
         // dd($duptweets);

    }

}
