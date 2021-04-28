<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Twitter;
use TwitterStreamingApi;
use App\Jobs\ProcessTweet;
use App\Events\BroadcastTweets;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

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
    protected $description = 'Scan twitter for tweets using #COVID19VerifiedResources';

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
        $keywords = config('app.tweet_keywords');
        $string = '';
        $i = 0;
        foreach($keywords as $keyword) {


            if($i != 0) {
                $string .= ' ';
            }

            $string .= $keyword;
            $i++;
        }

        $query = $string;
        $this->line('Scanning Twitter Feed for: '.$query);

        TwitterStreamingApi::publicStream()
        ->whenHears($query, function(array $tweet) {
            $tweet_data = [
                'id' => $tweet['id_str'],
                'avatar' => $tweet['user']['profile_background_image_url_https'],
                'text' => $tweet['text'],
                'user_name' => $tweet['user']['screen_name'],
                'name' => $tweet['user']['name'],
                'retweet_count' => $tweet['retweet_count'],
                'reply_count' => $tweet['reply_count'],
                'favorite_count' => $tweet['favorite_count'],
            ];
            if (isset($tweet['extended_tweet'])) {
                $tweet_data['text'] = $tweet['extended_tweet']['full_text'];
            }

            if (isset($tweet['created_at'])) {
                $tweet_data['date'] = date("Y-m-d H:i:s", strtotime($tweet['created_at']));
                $value = date("Y-m-d H:i:s", strtotime($tweet['created_at']));
                $tweet_data['diffForHumans'] = Carbon::parse($value . '  UTC')->tz('Asia/Kolkata')->diffForHumans();
                $tweet_data['momentJS'] = Carbon::parse($value . '  UTC')->tz('Asia/Kolkata')->format('YmdHi');
                $tweet_data['momentJS_IST'] = Carbon::parse($value . '  UTC')->format('YmdHi');
            }

            if (isset($tweet['extended_entities']['media'][0]['media_url'])) {
                $tweet_data['image'] = $tweet['extended_entities']['media'][0]['media_url'];
            }


            $twitterModel = new Twitter;

            $filterTweet = $twitterModel->filterTweet($tweet['text']);

            /*
                Screening the tweet as and when it streams.
                - Leonard, April 27th, 2021
            */
            if($filterTweet['type'] != 'ok') {
                    $this->info('Tweet by: '.$tweet_data['user_name'].', contains blacklisted words: '.$tweet['text'].'');
                    // File::put(storage_path().'/tweets/'.$tweet_data['user_name'].'.json', json_encode($tweet_data));
                    // File::put(storage_path().'/tweets_full/'.$tweet_data['user_name'].'.json', json_encode($tweet));
                } else {
                    $this->line('Tweet by: '.$tweet_data['user_name'].' streamed - OK');
                    ProcessTweet::dispatch($tweet_data);
                    broadcast(new BroadcastTweets($tweet_data))->toOthers();
            }
        })
        ->startListening();
    }
}
