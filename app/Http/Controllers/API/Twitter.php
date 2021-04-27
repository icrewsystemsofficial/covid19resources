<?php

namespace App\Http\Controllers\API;
use Exception;
use App\Models\User;
use App\Models\Mission;
use App\Models\Resource;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\Mission\Assigned;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use App\Models\Twitter as ModelsTwitter;

class Twitter extends Controller
{

    public function getstats() {
        $status = array();
        $status[] = ModelsTwitter::PENDING;
        $status[] = ModelsTwitter::VERIFIED;
        $status[] = ModelsTwitter::REFUTED;
        $status[] = ModelsTwitter::SPAM;
        $status[] = ModelsTwitter::INADEQUATE;
        $status[] = ModelsTwitter::RETWEET;
        $status[] = ModelsTwitter::SCREENED;

        $response = array();
        $data = array();
        foreach($status as $status) {
            $tweets = ModelsTwitter::where('status', $status)->count();
            $response['count'] = $tweets;

            switch($status) {
                case 0:
                    $response['name'] = 'Pending';
                    $response['color'] = 'dark';
                    $response['gradient'] = 'bg-warning-gradient';
                    $response['icon'] = 'question';
                break;

                case 6:
                    $response['name'] = 'Screened';
                    $response['color'] = 'warning';
                    $response['gradient'] = 'bg-warning-gradient';
                    $response['icon'] = 'check';
                break;

                case 1:
                    $response['name'] = 'Verified';
                    $response['color'] = 'success';
                    $response['gradient'] = 'bg-success-gradient';
                    $response['icon'] = 'check-circle';
                break;

                case 2:
                    $response['name'] = 'Refuted';
                    $response['color'] = 'danger';
                    $response['gradient'] = 'bg-danger-gradient';
                    $response['icon'] = 'exclamation-triangle';
                break;

                case 3:
                    $response['name'] = 'Spam';
                    $response['color'] = 'dark';
                    $response['gradient'] = 'bg-dark';
                    $response['icon'] = 'times-circle';
                break;

                case 4:
                    $response['name'] = 'Inadequate Info';
                    $response['color'] = 'dark';
                    $response['gradient'] = 'bg-dark';
                    $response['icon'] = 'question';
                break;

                case 5:
                    $response['name'] = 'Retweet';
                    $response['color'] = 'primary';
                    $response['gradient'] = 'bg-gradient-primary';
                    $response['icon'] = 'check';
                break;


                default:
                    throw new Exception('Unknown status ID type provided');
                break;
            }

            $data[$status] = $response;
        }

        $data['total'] = ModelsTwitter::count();
        $data['converted'] = Resource::where('tweet_id', '!=', null)->count();

        return $data;
    }


    public static function assignMissions($user, $howmany) {
        $latest = Mission::select('id', 'data', 'volunteer_id')->latest('created_at')->first();
        if($latest) {
            $latest_data = json_decode($latest->data);
            $latest_assigned_tweet = $latest_data[(count($latest_data) - 1)];
            // dd($latest_assigned_tweet);
            //$latest_assigned_tweet = json_decode($latest->data)[99];
        } else {
            $latest_assigned_tweet = '0';
        }



        $tweets = ModelsTwitter::select('id')->where('status', ModelsTwitter::SCREENED)
                    ->where('id', '>' ,$latest_assigned_tweet)
                    ->orderBy('created_at')
                    ->limit($howmany)
                    ->get();

        if(count($tweets) != '') {
            // dd($tweets);
            $processed_tweets = array();
            $i = 0;
            foreach($tweets as $tweet) {
                $processed_tweets[] = $tweet->id;
                $i++;
            }
            // dd($processed_tweets);
            $processed_tweets = json_encode($processed_tweets);
            $data = array(
                'uuid' => (string) Str::uuid(),
                'description' => 'Your mission objective is to call the phone numbers in the Tweets and verify if the information they have provided accurate & mark them as verified',
                'volunteer_id' => $user->id,
                'slot_start' => $tweets[0]->id,
                'slot_end' => $tweets[(count($tweets) - 1)]->id,
                'data' => $processed_tweets,
                'total' => count($tweets),
            );

            $mission = Mission::create($data);
            return $mission;
        } else {
            return "No tweets left";
        }
    }


    public function autoflag() {
        //Get total pending tweets & resources.
        //Get total number of users.
        // divide both to derive "X", and assign "X" number of missions accross users.

        $tweets = ModelsTwitter::where('status', ModelsTwitter::SCREENED)->get();
        // $volunteers = User::role('volunteer')->where('available_for_mission', 1)->get();
        $volunteers = User::where('available_for_mission', 1)->get();
        $total_tweets = $tweets->count();
        $total_volunteers = $volunteers->count();

        $how_many_tweets_to_assign = round($total_tweets / $total_volunteers);
        if($how_many_tweets_to_assign > config('app.max_tweets_to_assign_in_a_mission')) {
            $how_many_tweets_to_assign = config('app.max_tweets_to_assign_in_a_mission');
        }
        // dd($tweets->count());
        // dd($how_many_tweets_to_assign);

        $mission = array(); //These are mssions that will be created.
        $assigned_tweets = 0;
        foreach($volunteers as $volunteer) {
            $result = self::assignMissions($volunteer, $how_many_tweets_to_assign);
            if(is_object($result)) {
                $mission[] = $result;
                $assigned_tweets = $result->total + $assigned_tweets;
                $mail = Mail::to($volunteer->email)->send(new Assigned($result));
            } else {
                continue;
            }
        }


        if($assigned_tweets != 0) {
            echo "We were only able to assign ".$assigned_tweets." tweets in ".count($mission)." missions";
        } else {
            if($mission == []) {
                echo "All tweets assigned as missions";
            } else {
                echo "Success! We were able to assign ".$assigned_tweets." tweets in ".count($mission)." missions";
            }
        }


        // $mission = Mission::find(1);
        // $md = json_decode($mission->data);
        // echo Mission::select('id')->count();

    }

    public function autoflag_old2($id) {
        $tweets = ModelsTwitter::where('status', ModelsTwitter::PENDING)->limit(50)->get();
        $filtered = 0;
        foreach($tweets as $tweet) {
            $filterTweet = $tweet->filterTweet();
                if($filterTweet['type'] != 'ok') {
                    echo $filterTweet;
                    echo "<br>";
                    $tweet->status = ModelsTwitter::SPAM;
                    $tweet->update();
                    $filtered = $filtered + 1;
                } else {
                    $tweet->status = ModelsTwitter::SCREENED;
                    $tweet->update();
                }
                echo "<br>";
        }

        return $filtered;
    }

    public function autoflag_old($id) {
        $tweet = ModelsTwitter::find($id);

        //This gets the status data
        // dd($tweet->status_data()->name);

        // Auto flagging tweets.
        /*
            Step 0: Check if retweeted.
            Step 1: Filteration for blocked keywords.
            Step 2: Determining whether it's a request or resource.
            Step 3: Sending it the correct way.

        */

        // FIND SIMILAr TWEETS ACCORDING TO TWEET CONTENT
        $results = ModelsTwitter::where('id', '!=', $id)
                    ->where('tweet', 'LIKE', '%'. $tweet->tweet .'%')
                    // ->where('tweet', 'LIKE', '%RT%')->groupBy('tweet')
                    ->orderBy('created_at')
                    ->get();
        echo "Duplicates: ".count($results);
        echo "<br>";

        //This is activated ONLY if we know that the tweet is a retweet

        echo "Source Tweet: <br> ";
        echo $tweet->username;
        echo " : ".$tweet->tweet;
        echo "<br>";
        echo "<br>";

        foreach($results as $res) {
            echo $res->username;
            echo " : ".$res->tweet;
            // $retweets = ModelsTwitter::where('tweet', 'LIKE', '%'. $res->tweet .'%')->get();
            echo "<hr>";
        }

        //STEP 2. Determining if it's a source or a request.
        //Example Tweet: 50 Oxygen cylinders available in Chennai, Tamilnadu. For acquiring,
        //Please contact PHONE NUMBER. #COVID19VerifiedResource #COVID19India


        $blocked = array(
            'modi', 'amitshah', 'bjp', 'india'
        );


        // //To do,
        // $new = array();
        // foreach($blocked as $blocked) {
        //     $new[] = strtolower($blocked);
        // }


        $haystack = strtolower($tweet->tweet);
        $needle = $blocked;

        echo "Tweet: ".$tweet->tweet.'<br><br>';
        $check = Str::contains($haystack, $needle);
        if($check){
            echo "Contains blacklisted words";
            $reasons = array();
            $words = Str::of($haystack)->explode(' ');
            $blacklisted_because_of = array();
            foreach($words as $word) {
                if(Str::contains($word, $needle)) {
                    $blacklisted_because_of[] = $word;
                }
            }
            echo "<br>This tweet is marked as blacklisted because it contains the words: ";
            $i = 1;
            foreach($blacklisted_because_of as $bwords) {
                echo $i.'). '.$bwords.' ';
                $i++;
            }
        } else {
            echo "Tweet is clean";
        }
    }

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

        $tweets = Http::withToken('AAAAAAAAAAAAAAAAAAAAANYqOwEAAAAAAcChMHxkRy4VCUkVfHWNDAhpjEs%3Dt1g7L7z2CQaDalZVV41ZVJNHzvKfdzVGXf3KQqBr9dnrDMTRY9')->get('https://api.twitter.com/1.1/search/tweets.json', [
            'q' => '#Verified #COVID19India',
            'include_entities' => false,
            'count' => 100,
            'result_type' => 'recent',
        ]);

        // $tweets = Http::withToken('AAAAAAAAAAAAAAAAAAAAANYqOwEAAAAAAcChMHxkRy4VCUkVfHWNDAhpjEs%3Dt1g7L7z2CQaDalZVV41ZVJNHzvKfdzVGXf3KQqBr9dnrDMTRY9')
        //                 ->get('https://api.twitter.com/1.1/search/tweets.json', [
        //                     'q' => '#Verified #COVID19India',
        //                     'include_entities' => false,
        //                     'count' => 100,
        //                     'result_type' => 'recent',
        //                 ]);

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
