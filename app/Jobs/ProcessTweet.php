<?php

namespace App\Jobs;

use App\Models\Twitter;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class ProcessTweet implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $tweet_data;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($tweet_data)
    {
        $this->tweet_data = $tweet_data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $twitter = new Twitter;
        $twitter->tweet_id = $this->tweet_data['id'];
        $twitter->tweet = $this->tweet_data['text'];
        $twitter->tweet_timestamp = $this->tweet_data['date'];
        $twitter->username = $this->tweet_data['user_name'];
        $twitter->fullname = $this->tweet_data['name'];
        $twitter->avatar = $this->tweet_data['avatar'];
        $twitter->retweeted = $this->tweet_data['retweet_count'];
        $twitter->status = 0;
        $twitter->save();
    }
}
