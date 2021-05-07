<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Models\User;
use App\Models\Mission;
use App\Models\Twitter;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\Mission\Assigned;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class MissionAdmin extends Controller
{
    public function index() {
        $missions = Mission::all();
        return view('dashboard.admin.missions.index', [
            'missions' => $missions,
        ]);
    }

    public function assign() {
        $users = User::where('available_for_mission', 1)->get();
        return view('dashboard.admin.missions.assign', [
            'users' => $users,
        ]);
    }

    public function dissolve($id) {
        if($id == '') {
            notify()->error('Mission ID missing', 'Whoops');
            return redirect(route('admin.mission.index'));
        }

        $mission = Mission::find($id);
        $mission->delete();
        activity()->log('Mission Admin: Mission # '.$id.' was dissolved');
        notify()->success('Mission was dissolved, please assign a new mission to another volunteer', 'Hmmm, okay');
        return redirect(route('admin.mission.index'));
    }

    public static function assignMissions_manual($user, $howmany, $type, $description) {
        $latest = Mission::select('id', 'data', 'volunteer_id')->latest('created_at')->first();
        // if($latest) {
        //     $latest_data = json_decode($latest->data);
        //     $latest_assigned_tweet = $latest_data[(count($latest_data) - 1)];
        //     // dd($latest_assigned_tweet);
        //     //$latest_assigned_tweet = json_decode($latest->data)[99];
        // } else {
        //     $latest_assigned_tweet = '0';
        // }



        $tweets = Twitter::select('id')->where('status', Twitter::SCREENED)
                    // ->where('id', '>' ,$latest_assigned_tweet)
                    ->orderBy('created_at')
                    ->limit($howmany)
                    ->get();

        if(count($tweets) != '') {
            $processed_tweets = array();
            $i = 0;
            foreach($tweets as $tweet) {
                $processed_tweets[] = $tweet->id;
                $i++;
            }
            // dd($processed_tweets);
            $processed_tweets = json_encode($processed_tweets);
            $data = array(
                'uuid' => (string) Str::uuid(),
                'type' => $type,
                'description' => $description,
                'volunteer_id' => $user,
                'slot_start' => $tweets[0]->id,
                'slot_end' => $tweets[(count($tweets) - 1)]->id,
                'data' => $processed_tweets,
                'total' => count($tweets),
            );

            $mission = Mission::create($data);
            return $mission;
        } else {
            return "No tweets left";
        }
    }

    public static function assignMissions($user, $howmany, $type, $description) {
        $latest = Mission::select('id', 'data', 'volunteer_id')->latest('created_at')->first();
        if($latest) {
            $latest_data = json_decode($latest->data);
            $latest_assigned_tweet = $latest_data[(count($latest_data) - 1)];
            // dd($latest_assigned_tweet);
            //$latest_assigned_tweet = json_decode($latest->data)[99];
        } else {
            $latest_assigned_tweet = '0';
        }



        $tweets = Twitter::select('id')->where('status', Twitter::SCREENED)
                    ->where('id', '>' ,$latest_assigned_tweet)
                    ->orderBy('created_at')
                    ->limit($howmany)
                    ->get();

        if(count($tweets) != '') {
            // dd($tweets);
            $processed_tweets = array();
            $i = 0;
            foreach($tweets as $tweet) {
                $processed_tweets[] = $tweet->id;
                $i++;
            }
            // dd($processed_tweets);
            $processed_tweets = json_encode($processed_tweets);
            $data = array(
                'uuid' => (string) Str::uuid(),
                'type' => $type,
                'description' => $description,
                'volunteer_id' => $user,
                'slot_start' => $tweets[0]->id,
                'slot_end' => $tweets[(count($tweets) - 1)]->id,
                'data' => $processed_tweets,
                'total' => count($tweets),
            );

            $mission = Mission::create($data);
            return $mission;
        } else {
            return "No tweets left";
        }
    }

    public function create(Request $request) {
        // dd($request->input());
        $volunteer_data = User::find(request('volunteer_id'));
        $volunteer = $volunteer_data->id;
        $how_many_tweets_to_assign = request('total');

        $result = self::assignMissions_manual($volunteer, $how_many_tweets_to_assign, request('type'), request('description'));
            if(is_object($result)) {
                $mission[] = $result;
                $assigned_tweets = $result->total;
                activity()->log('Mission Admin: Assigned a mission to verify resources ('.$result->total.') to volunteer '. $volunteer_data->id);
                Mail::to($volunteer_data->email)->send(new Assigned($result));
                notify()->success('Mission was assigned to the user successfully', 'Yay');
                return redirect(route('admin.mission.index'));
            } else {
                notify()->error('Was unable to assign mission to the user, because there were no resources left to assign', 'Whoops');
                return redirect(route('admin.mission.index'));
            }
    }

    public function manage($uuid) {

        if($uuid == '') {
            notify()->error('Mission UUID was not passed', 'Whoops');
            return redirect(route('admin.mission.index'));
        }

        $mission=Mission::where('uuid','$uuid')->first();
        if($mission){
            return view('dashboard.admin.missions.manage',[
                'mission' => $mission,
            ]);
        }else {
            notify()->error('This mission does not exist','Whoops');
            return redirect(route('admin.mission.index'));
        }
    }

    public function update($uuid){

        $mission = Mission::find($uuid);
        $mission->volunteer_id = request('volunteer_id');
        $mission->status = request('status');
        $mission->description = request ('description');

        $mission->update();

        notify()->success('Mission was updated','Yayy!');
        return redirect(route('admin.mission.index'));
        
    }
}
