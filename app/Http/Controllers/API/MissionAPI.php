<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\Mission;
use App\Models\Twitter;
use App\Models\Resource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MissionAPI extends Controller
{
    public function getstats() {
        $status = array();

        $status[] = Mission::ASSIGNED;
        $status[] = Mission::INPROGRESS;
        $status[] = Mission::DELAYED;
        $status[] = Mission::COMPLETED;
        $status[] = Mission::MISSION_TWEET;
        $status[] = Mission::MISSION_RESOURCE;

        $response = array();
        $data = array();
        foreach($status as $status) {
            $missions = Mission::where('status', $status)->count();
            $response['count'] = $missions;

            switch($status) {
                case 0:
                    $response['name'] = 'Assigned';
                    $response['color'] = 'warning';
                    $response['gradient'] = 'bg-warning-gradient';
                    $response['icon'] = 'circle-notch';
                break;

                case 1:
                    $response['name'] = 'In Progress';
                    $response['color'] = 'primary';
                    $response['gradient'] = 'bg-primary-gradient';
                    $response['icon'] = 'sync fa-spin';
                break;

                case 2:
                    $response['name'] = 'Delayed';
                    $response['color'] = 'danger';
                    $response['gradient'] = 'bg-danger-gradient';
                    $response['icon'] = 'exclamation-triangle';
                break;

                case 3:
                    $response['name'] = 'Completed';
                    $response['color'] = 'success';
                    $response['gradient'] = 'bg-success-gradient';
                    $response['icon'] = 'check';
                break;


                default:
                    throw new Exception('Unknown Mission status ID type provided');
                break;
            }

            $data[$status] = $response;
        }

        $data['total'] = Mission::count();
        $data['total_resources_assigned_in_missions'] = Mission::sum('total');
        // $data['converted'] = Resource::where('tweet_id', '!=', null)->count();
        $data['total_assigned'] = Mission::where('status', Mission::ASSIGNED)->sum('total');
        $data['total_completed'] = Mission::where('status', Mission::COMPLETED)->sum('total');
        $data['pendingtweets'] = Twitter::where('status', Twitter::SCREENED)->count();

        return $data;
    }

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
