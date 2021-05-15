<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\Twitter;
use Carbon\CarbonPeriod;
use Carbon\CarbonInterval;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class StatsAPI extends Controller
{
    public static function dataInput() {

        //Tweets.
        //Resources.
        //Faqs.

      $first_tweet = (Twitter::select('created_at')->oldest()->first())->created_at->format('d/m/Y');
        $last_tweet = (Twitter::select('created_at')->latest()->first())->created_at->format('d/m/Y');

        $startDate = Carbon::createFromFormat('d/m/Y', $first_tweet);
        $endDate = Carbon::createFromFormat('d/m/Y', $last_tweet);

        $dateRange = CarbonPeriod::create($startDate, $endDate);
        $data = array();
        $labels = array();
        $total = 0;
        foreach($dateRange->toArray() as $day) {
            $count = Twitter::whereDate('created_at', $day->format('Y-m-d'))->count();

            $labels[] = $day->format('d-m-Y');
            $data[] =  $count;
            $total = $total + $count;
        }

        $response = array(
            'labels' => json_encode($labels),
            'data' => json_encode($data),
            'total' => $total,
        );

        // $cached = Cache::get('dataInput');
        // if(!$cached) {
        //     $cached = Cache::put('dataInput', $response, now()->addHours(12));
        // } else {

        // }
        return $response;
    }
}
