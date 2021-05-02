<?php

namespace App\Http\Controllers\Api;

use App\Models\Twitter;
use App\Models\Category;
use App\Models\Resource;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchFilterController extends Controller
{

    public function search($query) {
        $response = array();

        // Algolia
        $tweets = Twitter::search($query)->get();

        //DB Search
        $search_fields = ['tweet', 'fullname', 'username'];
        $search_terms = explode(' ', $query);

        $db_search = Twitter::query();
        foreach ($search_terms as $term) {
            $db_search->orWhere(function ($db_search) use ($search_fields, $term) {

                foreach ($search_fields as $field) {
                    $db_search->orWhere($field, 'LIKE', '%' . $term . '%');
                }
            });
        }

        $filtered = $db_search->select('tweet', 'fullname', 'username', 'created_at', 'updated_at', 'tweet_id')
                    ->orderBy('created_at', 'DESC')
                    // ->limit(500)
                    ->get();

        $response['query'] = $query;
        $response['algolia_total'] = $tweets->count();
        $response['algolia'] = $tweets;

        $response['database_total'] = $filtered->count();
        $response['database'] = $filtered;
        return response($response);
    }

    public function search_old($searchTerm) {
        $search_fields = ['tweet', 'fullname', 'username'];
        $search_terms = explode(' ', $searchTerm);

        $query = Twitter::query();
        foreach ($search_terms as $term) {
            $query->orWhere(function ($query) use ($search_fields, $term) {

                foreach ($search_fields as $field) {
                    $query->orWhere($field, 'LIKE', '%' . $term . '%');
                }
            });
        }

        $filtered = $query->select('tweet', 'fullname', 'username')
                    ->orderBy('created_at', 'DESC')
                    // ->limit(500)
                    ->get();


        return response($filtered);

        /*
            Now, we have all the entries in the DB which contains either of
            the words from the query.

            Eg :

            SEARCH TERM : Beds Delhi
            Results: all tweets which either have the word "beds" or "Delhi"
        */


        $terms = array();
        foreach($search_terms as $term) {
            $terms[] = strtolower($term);
        }

        $search_terms = $terms;

        $total_terms_to_search = count($search_terms);
        echo "Terms to search: ".$total_terms_to_search;
        echo "<br>";
        echo "<br>";
        foreach($filtered as $result) {

            /*
                Suppose we are getting 5 queries,
                we are looping through all 5 of them,
                trying to find the the tweets with ALL
                of the search terms in it.

                It's like finding a needle in a haystack.
            */


            $haystack = strtolower($result->tweet);
            $needle = $search_terms;

            $words = Str::of($haystack)->explode(' ');
            $results_containing_keyword = array();

            $matched_keywords = 0;
                foreach($words as $word) {
                    if(Str::contains($word, $needle)) {
                        $results_containing_keyword[] = $word;
                        // echo $word;
                        // echo "<br>";
                        $matched_keywords++;
                    }


                    //Check duped keywords
                    if(Str::contains($word, $results_containing_keyword)) {
                        // echo "'$word' - exists more than once in this tweet";
                        // echo "<br>";
                        $matched_keywords = $matched_keywords - 1;
                    } else {
                        $matched_keywords++;
                    }
                }


                if($total_terms_to_search > $matched_keywords) {
                    // echo "<br> Tweets dont contain the provided keyword combinations";
                } else {
                    // echo $result->tweet ." : contans combination";
                    // echo "<hr>";
                    $response = "<br>". $haystack." | <b>Contains</b>: ";
                    $i = 1;
                        foreach($results_containing_keyword as $bwords) {
                            $response .= $i.'). '.$bwords;
                                if($i != 1) {
                                    // Add spaces to plurals.
                                    $response .= '  ';
                                }
                            $i++;
                        }
                    echo $response;
                    echo "<hr>";
                }
        }

        // return response($response);
        return;
    }

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
