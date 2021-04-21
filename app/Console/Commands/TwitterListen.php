<?php

namespace App\Console\Commands;

use App\Models\Twitter;
use TwitterStreamingApi;
use Illuminate\Console\Command;

class TwitterListen extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'twitter:scan';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scan twitter for tweets using #covid19resources';

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
        TwitterStreamingApi::publicStream()
        ->whenHears('#COVID19', function(array $tweet) {
            $tweet_data = [
                'text' => $tweet['text'],
                'user_name' => $tweet['user']['screen_name'],
                'name' => $tweet['user']['name'],
                'profile_image_url_https' => $tweet['user']['profile_image_url_https'],
                'retweet_count' => $tweet['retweet_count'],
                'reply_count' => $tweet['reply_count'],
                'favorite_count' => $tweet['favorite_count'],
            ];
            if (isset($tweet['extended_tweet'])) {
                $tweet_data['text'] = $tweet['extended_tweet']['full_text'];
            }

            if (isset($tweet['created_at'])) {
                $tweet_data['date'] = date("M d, Y H:i A", strtotime($tweet['created_at']));
            }

            if (isset($tweet['extended_entities']['media'][0]['media_url'])) {
                $tweet_data['image'] = $tweet['extended_entities']['media'][0]['media_url'];
            }

            echo $tweet_data['user_name'].' '.$tweet['text'].' '.$tweet_data['date'];
            // echo $tweet['id'];

            // $twitter = new Twitter;
            // $twitter->tweet_id = $tweet['id'];
            // $twitter->tweet = $tweet_data['text'];
            // $twitter->extended_tweet = $tweet_data['extended_tweet'];
            // $twitter->username = $tweet_data['username'];
            // $twitter->fullname = $tweet_data['name'];
            // $twitter->json = $tweet;
            // $twitter->status = 0;
        })
        ->startListening();
    }
}
