<?php

namespace App\Http\Controllers\API;

use App\Models\States;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class Location extends Controller
{
    public static function currentLocation() {
        $location = Cache::get('location');
        if($location == '') {
            // TODO: Make this dynamic by Geolocation.
            $location = 'TN';
            self::currentLocation_update($location);
            $state = array(
                'name' => 'Tamil Nadu',
                'code' => 'TN',
            );

            return false;
        } else {
            // $states = States::all();
            // if(!$states->isEmpty())
            $state = States::where('code', $location)->first();
            return $state;
        }
    }

    public static function locationDisplay() {
        $location = self::currentLocation();
        if(is_object($location)) {
            $state = States::where('code', $location->code)->first();
            return $state;
        } else {
            return false;
        }
    }

    public static function currentLocation_update($code) {
        $state = States::where('code', $code)->first();
        Cache::put('location', $code, now()->addHours(1));
        return $state;
    }
}
