<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\States;
use App\Models\Twitter;
use App\Models\Category;
use App\Models\Resource;
use App\Search\SearchAggregator;
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
//        $tweets = Twitter::search($query)->orderBy('created_at', 'DESC')->get();

        $results = SearchAggregator::search($query)->where('verified', '1')->get();
//        dd($results);
  //      $tweets = Twitter::search($query, function ($algolia, $query, $options) {
		// $extraOptions = [
		//         'paginationlimitedto' => 5000,
		//     ];rtvybuhn
		//     $options = array_merge($options, $extraOptions);
		//     return $algolia->search($query, $options);
		// });
		
	
		
        return view('dashboard.home.search.results', [
            'results' => $results,
            'query' => $query,
        ]);
    }

    public function view($id){
//        $tweet = Twitter::find($id);
        $resource = Resource::find($id);
        if(!$resource) {
            notify()->error('Resource with given parameters were not found', 'Whoops');
            return redirect(route('admin.resources.index'));
        }


        // Try to find other tweets by the same user.
//        $other_tweets = Twitter::where('username', $tweet->username)->where('id', '!=', $id)->get();

        return view('dashboard.home.view', [
            'resource' => $resource,
            'other_tweets' => $other_tweets,
        ]);
    }
}
