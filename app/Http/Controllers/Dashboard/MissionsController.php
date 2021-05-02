<?php

namespace App\Http\Controllers\Dashboard;

use Exception;
use App\Models\User;
use App\Models\Mission;
use App\Models\Twitter;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MissionsController extends Controller
{
    public function index() {
        $missions = Mission::where('volunteer_id', auth()->user()->id)->orderBy('status')->get();
        return view('dashboard.home.missions.index', [
            'missions' => $missions,
        ]);
    }

    public function leaderboard() {

        // $users = User::role('volunteer')->get();
        // foreach($users as $user) {
        //     echo $user->name;
        //     echo "<br>";
        // }

        $users = array();
        $mission_volunteers = Mission::where('status', '!=', Mission::COMPLETED)->groupBy('volunteer_id')->get();

        foreach($mission_volunteers as $mission) {
            $mission_of_volunteer = Mission::where('volunteer_id', $mission->getVolunteer->id)->get();
            $user = $mission->getVolunteer;

            $users[$mission->getVolunteer->id] = array(
                'name' => $user->name,
                'points' => $user->points,
                'total' => $mission_of_volunteer->count(),
                'inprogress' => $mission_of_volunteer->where('status', Mission::INPROGRESS)->count(),
                'completed' => $mission_of_volunteer->where('status', Mission::COMPLETED)->count(),
            );
        }


        //Sorting the array by "Completed Missions"
        $sorted = array_values(Arr::sort($users, function ($value) {
            return $value['completed'];
        }));


        $sorted = array_reverse($sorted);

        return view('dashboard.home.missions.leaderboard', [
            'datum' => (object) $sorted,
        ]);
    }

    public function view($uuid = '') {
        if($uuid == '') {
            notify()->error('Mission UUID was not passed', 'Whoops');
            return redirect(route('home.mission.index'));
        }

        $mission = Mission::where('uuid', $uuid)->first();
        if($mission) {
            return view('dashboard.home.missions.view', [
                'mission' => $mission,
            ]);
        } else {
            notify()->error('This mission does not exist', 'Whoops');
            return redirect(route('home.mission.index'));
        }
    }
}
