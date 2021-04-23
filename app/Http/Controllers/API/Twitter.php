<?php

namespace App\Http\Controllers\API;

use TwitterStreamingApi;
use Illuminate\Http\Request;
// use Spatie\LaravelTwitterStreamingApi\TwitterStreamingApi;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class Twitter extends Controller
{


   public function index() {
        $tweets = Http::withToken('AAAAAAAAAAAAAAAAAAAAANYqOwEAAAAAAcChMHxkRy4VCUkVfHWNDAhpjEs%3Dt1g7L7z2CQaDalZVV41ZVJNHzvKfdzVGXf3KQqBr9dnrDMTRY9')
                        ->get('https://api.twitter.com/2/tweets', [
                            // 'q' => '#Verified #COVID19India',
                            // 'include_entities' => false,
                            // 'count' => 100,
                            // 'result_type' => 'recent',
                            'ids' => '1385165724914651138',
                        ]);

        dd($tweets->json());

        $data = $tweets->json()['statuses'];
        foreach($data as $tweet) {
            echo $tweet['text'];
            echo "<br>";
            echo "Tweet ID: ".$tweet['id'];
            echo "<br>";
            echo "User: ".$tweet['user']['name'].' ('.$tweet['user']['screen_name'].' | Location'. $tweet['user']['location'];
            echo "<br>";
            echo "<hr>";
        }
   }
}
