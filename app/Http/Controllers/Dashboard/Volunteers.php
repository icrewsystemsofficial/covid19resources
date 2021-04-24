<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Twitter;
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
}
