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
        $tweets = Twitter::search($query)->orderBy('created_at', 'DESC')->get();

        return view('dashboard.home.search.results', [
            'results' => $tweets,
            'query' => $query,
        ]);
    }
}
