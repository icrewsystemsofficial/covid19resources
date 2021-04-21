<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// use Spatie\LaravelTwitterStreamingApi\TwitterStreamingApi;
use TwitterStreamingApi;
class Twitter extends Controller
{


   public function index() {
    TwitterStreamingApi::publicStream()
    ->whenHears('#covid19india', function(array $tweet) {
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
        echo "<br>";
        // echo $tweet['id'];
    })
    ->startListening();
   }
}
