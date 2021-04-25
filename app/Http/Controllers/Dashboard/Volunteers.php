<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Mission;
use App\Models\Twitter;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Volunteers extends Controller
{
    public function index() {

        // $slot_start = '5';
        // $slot_end = '200';

        $slot = array(1, 1000); // Get mission details.


        $tweets = new Twitter;
        $tweets_stream = $tweets
        ->where('status', '=', Twitter::SCREENED)
        ->whereBetween('id', $slot)
        ->orderBy('created_at')
        ->paginate(50);

        return view('dashboard.home.volunteers.index', [
            'tweets' => $tweets_stream,
        ]);
    }

    public function getAllMissions() {
        $missions = Mission::orderBy('status')->get();
        // dd($missions);
        foreach($missions as $mission) {
            echo $mission->status;
            echo "<br>";
        }
    }

    public function test() {
        //Find tweets that are screened.
        //Starting number + 100.
        //Return range.

        $latest = Mission::select('id', 'data')->latest('created_at')->first();
        if($latest) {
            $latest_data = json_decode($latest->data);
            $latest_assigned_tweet = $latest_data[(count($latest_data) - 1)];
            // dd($latest_assigned_tweet);
            //$latest_assigned_tweet = json_decode($latest->data)[99];
        } else {
            $latest_assigned_tweet = '0';
        }

        // dd($latest_assigned_tweet);


        $tweets = Twitter::select('id')->where('status', Twitter::SCREENED)
                    ->where('id', '>' ,$latest_assigned_tweet)
                    ->orderBy('created_at')
                    ->limit('100')
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
                'volunteer_id' => auth()->user()->id,
                'slot_start' => $tweets[0]->id,
                'slot_end' => $tweets[(count($tweets) - 1)]->id,
                'data' => $processed_tweets,
                'total' => count($tweets),
            );

            $mission = Mission::create($data);
            dd($mission->slot_end);
        } else {
            echo "No tweets left! Good job";
        }

        // $mission = Mission::find(1);
        // $md = json_decode($mission->data);
        // echo Mission::select('id')->count();



    }
}
