<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Twitter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    public function search() {
        return view('dashboard.home.search.index');
    }

    public function results(Request $request) {

        $query = $request->input('query');
        if($query == '') {
            notify()->info('You haven\'t mentioned what you\'re searching for', 'Wait a minute...');
            return redirect(route('home.search'));
        }
        $tweets = Twitter::search($query)->get();

        return view('dashboard.home.search.results', [
            'results' => $tweets,
            'query' => $query,
        ]);
    }

    public function view($id){
        $tweet = Twitter::find($id);
        if(!$tweet) {
            notify()->error('Tweet with given parameters were not found', 'Whoops');
            return redirect(route('admin.twitter.index'));
        }

        $resources = Resource::where('tweet_id', $id)->get();

        // Try to find other tweets by the same user.
        $other_tweets = Twitter::where('username', $tweet->username)->where('id', '!=', $id)->get();

        return view('dashboard.admin.twitter.view', [
            'tweet' => $tweet,
            'other_tweets' => $other_tweets,
            'resources' => $resources,
            'categories' => Category::where('status', 1)->get(),
            'states' => States::all(),
        ]);
    }
}
