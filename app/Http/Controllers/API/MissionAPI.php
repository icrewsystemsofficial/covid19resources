<?php

namespace App\Http\Controllers\API;

use App\Models\Mission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MissionAPI extends Controller
{
    public function changeStatus($id = '', $status = '') {
        $response = array();
        if($id == '' || $status == '') {
            $response['type'] = 'error';
            $response['message'] = 'ID or STATUS missing';
            return response($response);
        }

        $mission = Mission::find($id);
        $mission->status = $status;
        $mission->update();

        $response['type'] = 'success';
        $response['message'] = 'Mission has been updated to status: '.$status;
        return response($response);
    }

    public function completedCount($id = '', $count = '') {
        $response = array();
        if($id == '' || $count == '') {
            $response['type'] = 'error';
            $response['message'] = 'ID or STATUS missing';
            return response($response);
        }

        $mission = Mission::find($id);
        $mission->completed = $count;
        $mission->update();

        $response['type'] = 'success';
        $response['message'] = 'Mission completion count has been updated to: '.$count;
        return response($response);
    }
}
