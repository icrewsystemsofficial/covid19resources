<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Mission;
use App\Models\Twitter;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;

class MissionsController extends Controller
{
    public function index() {
        $missions = Mission::where('volunteer_id', auth()->user()->id)->orderBy('status')->get();
        return view('dashboard.home.missions.index', [
            'missions' => $missions,
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
