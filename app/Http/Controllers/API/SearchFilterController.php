<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Resource;
use App\Models\Twitter;
use Illuminate\Http\Request;

class SearchFilterController extends Controller
{
    public function resource_search_filter($query = '')
    {   
       
        $search_results = Resource::where('title','like','%'.$query.'%')
                                        ->orWhere('city','like','%'.$query.'%')
                                        ->orWhere('district','like','%'.$query.'%')
                                        ->orWhere('state','like','%'.$query.'%')
                                        ->orWhere('landmark','like','%'.$query.'%')->get();
                
        return $search_results;
      
        // return view('dashboard.home.results')->with('search_results',$search_results);
    }

    public function twitter_search_filter($query = '')
    {
        $twitter = Twitter::where('tweet','like','%'.$query.'%')->orWhere('tweet_id','like','%'.$query.'%')->get();

        return $twitter;
    }
}
