<?php

namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use App\Models\Twitter as ModelsTwitter;

class Twitter extends Controller
{
    public function delete_tweet($id) {
        $respone = array();

        ModelsTwitter::find($id)->delete();
        $respone['message'] = 'Tweet was deleted';
        return response($respone);
    }

    public function change_status($id = '', $status = '') {
        $respone = array();
        if($id == '' || $status == '') {
            $respone['message'] = 'ID or STATUS was not passed with the request';
            $respone['type'] = 'error';
            return response($respone);
        }

        //TO:DO This needs to be made into some sort of STD class.
        $allowed_statuses = array('0', '1', '2', '3', '4');

        if(!in_array($status, $allowed_statuses)) {
            $respone['message'] = 'Unknown status type';
            $respone['type'] = 'error';
            return response($respone);
        }

        $tweet = ModelsTwitter::find($id);
        if(!$tweet) {
            $respone['message'] = 'Tweet with ID not found';
            $respone['type'] = 'error';
            return response($respone);
        } else {
            $tweet->status = $status;
            $tweet->update();
            $respone['message'] = 'Tweet was updated';
            $respone['type'] = 'success';
            return response($respone);
        }

    }

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
