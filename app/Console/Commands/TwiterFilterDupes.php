<?php

namespace App\Console\Commands;

use App\Models\Twitter;
use Illuminate\Console\Command;

class TwiterFilterDupes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'twitter:duplicates {howmany=100}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Find out all tweets with %RT%, query them for repatitiveness and then mark them as re-tweeted.';

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
            $this->info('Filtering upto ' . $this->argument('howmany') .' re-tweets');

                $screened_tweet = Twitter::where('status', Twitter::SCREENED)
                    ->where('tweet', 'LIKE', '%RT%')
                    ->orderBy('created_at')
                    // ->limit($this->argument('howmany'))
                    ->get();

                    $i = 0;

                    if(count($screened_tweet) > 0) {

                        foreach($screened_tweet as $screened) {
                            //Max Exit.
                            // FINDING DUPLICATES
                            $duplicates = Twitter::
                                    where('id', '!=', $screened->id)
                                    ->where('status', '!=', Twitter::RETWEET)
                                    ->where('tweet', 'LIKE', '%'. $screened->tweet .'%')
                                    ->orderBy('created_at')
                                    ->get();

                            if(count($duplicates) > 0) {
                                $this->line('Finding duplicates for '.$screened->tweet);

                                {
                                    foreach($duplicates as $dupe) {

                                        if($i == $this->argument('howmany')) {
                                            $this->info('Success! Marked '.$i. ' retweets');
                                            return;
                                        } else {
                                            $this->line('Found: '.$dupe->id);
                                            $dupe->status = Twitter::RETWEET;
                                            $dupe->update();
                                            $i++;
                                        }
                                    }
                                }
                            }


                        }

                    }

                if($i == 0) {
                    $this->info('Good Job! There are no tweets pending for re-tweeting');
                } else {
                    $this->info('Success! Marked '.$i. ' retweets');
                }
    }
}
