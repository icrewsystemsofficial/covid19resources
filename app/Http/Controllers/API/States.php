<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Districts;
use Illuminate\Http\Request;

class States extends Controller
{
    public function getDistricts($code) {
        $response = array();
        if($code == '') {
            $response['message'] = 'Select a state / union territory first';
        } else {
            $districts = Districts::where('code', $code)->get();
            $response['message'] = 'Districts in '.$code.'';
            $response['districts'] = $districts;
        }

        return response($response);
    }

    public function getCities($state) {
        $response = array();
        if($state == '') {
            $response['message'] = 'Select a state / union territory first';
        } else {
            $cities = array();

            $cities[0] = array(
                'name' => '* All Cities',
                'district' => '* All Districts',
            );

            foreach(City::where('state', $state)->get() as $city) {
                $cities[] = $city;
            }

            $cities[] = array(
                'name' => '* Unavailable',
                'district' => '* Check Landmark',
            );

            $response['message'] = 'Cities in '.$state.'';
            $response['districts'] = $cities;
        }
        return response($response);
    }
}
