<?php

namespace App\Http\Controllers\Dashboard;

use App\Exports\Covid19MassExport;
use App\Models\FAQ;
use App\Models\City;
use App\Models\User;
use App\Models\States;
use App\Models\Twitter;
use App\Models\Category;
use App\Models\Referral;
use App\Models\Resource;
use App\Models\Districts;
use App\Mail\WelcomeEmail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Jobs\SendReportJob;
use App\Jobs\WelcomeMailJob;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Mail\ResourceRefuted;
use App\Models\Activity;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Activitylog\Models\Activity as LogActivity;

class HomeController extends Controller
{
    public function add_resource() {
        return view('dashboard.home.add_resource', [
            'categories' => Category::where('status', 1)->get(),
            'states' => States::all(),
        ]);
    }

    public function save_resource(Request $request) {
        $create_account = request('create_account');
        if($create_account != null) {
            //Find existing user by that email.
            $existing_user = User::where('email', request('email'))->first();
            if($existing_user) {
                Auth::attempt(['email' => $existing_user->email, 'password' => request('password')]);
                $user = $existing_user;
            } else {
                $request->validate([
                    'name' => 'required|string|max:255',
                    'email' => 'required|string|email|max:255|unique:users',
                    'state' => 'required|string|max:30',
                    'password' => 'required|string|confirmed|min:8',
                ]);

                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'state' => $request->state,
                    'password' => Hash::make($request->password),
                ]);


                $user->assignRole('user');

                event(new Registered($user));

                Auth::login($user);

                Mail::to($user->email)->send(new WelcomeEmail($user->name));
                activity()->log('Profile Create: New User Profile created');
            }
        }

        // Process the resource.
        if(!isset($user)) {
            $user = auth()->user();
        }

        $resource = new Resource;
        $resource->category = request('category');
        $resource->title = request('name');
        $resource->body = request('body');
        $resource->phone = request('phone');
        $resource->url = request('url');
        $resource->author_id = $user->id;
        $resource->verified = request('status');

        if(request('status') == 1) {
            $resource->verified_by = $user->id;
        }



        if(request('city') == '* All Cities') {
        	$resource->city = request('city');
        	$resource->district = '* All Districts';
		    $resource->state = request('state');
		    $resource->hasAddress = 0;
        } else if(request('city') == '* Unavailable') {
        	$resource->city = request('city');
        	$resource->district = '* Unavailable';
		    $resource->state = request('state');
		    $resource->hasAddress = 0;
        } else {
        	$city = City::where('name', request('city'))->first();

            if($city) {
                $resource->city = $city->name;
                $resource->district = $city->district;
                $resource->state = $city->state;
                $resource->hasAddress = 1;
                $resource->landmark = request('landmark');
            } else {
                //If city is not traceable in the DB
                $resource->city = request('city');
                $resource->district = 'Unknown';
                $resource->state = request('state');
                $resource->hasAddress = 0;
            }
        }

        $resource->save();

        return redirect(route('home.view', $resource->id));
    }

    public function index() {
        $resources = Resource::
                        where('state', \App\Http\Controllers\API\Location::locationDisplay()->name)
                        ->get();
        return view('dashboard.home.home', [
            'states' => States::select('name', 'code')->get(),
            'resources' => $resources,
        ]);
    }

    public function about() {
        return view('dashboard.static.about');
    }

    public function how_to() {


        return view('dashboard.static.howto');
    }

    public function crowdsourced_index(){
        return view('dashboard.home.crowdsourced.index');
    }

    public function crowdsourced_websites(){
        return view('dashboard.home.crowdsourced.websites');
    }

    public function crowdsourced_instagram(){
        return view('dashboard.home.crowdsourced.instagram');
    }

    public function crowdsourced_telegram(){
        return view('dashboard.home.crowdsourced.telegram');
    }

    public function crowdsourced_discord(){
        return view('dashboard.home.crowdsourced.discord');
    }

    public function crowdsourced_helplines(){
        return view('dashboard.home.crowdsourced.helpline');
    }



    public function statistics() {
        // Resources Count
        $verified=Resource::where('verified','=',1)->count();
        $pending=Resource::where('verified','=',0)->count();
        $spam=Resource::where('verified','=',3)->count();
        $total=Resource::all()->count();



        //Users Count
        $volunteer_users = User::whereHas("roles", function($q){ $q->where("name","volunteer"); })->get();
        $admin_users = User::whereHas("roles", function($q){ $q->where("name","superadmin"); })->get();
        $total_users = User::all()->count();

        $volunteer_count=count($volunteer_users);
        $admin_count=count($admin_users);


        //Twitter Count
        $total_tweets=Twitter::all()->count();
        $verified_tweets=Twitter::where('status','=',1)->get();
        $pending_tweets=Twitter::where('status','=',0)->get();
        $inadequate_tweets=Twitter::where('status','=',4)->get();

        $count_verified=count($verified_tweets);
        $count_pending=count($pending_tweets);
        $count_inadequate=count($inadequate_tweets);


        return view('dashboard.static.statistics',[
            'resources_verified'=> $verified,
            'resources_pending'=>$pending,
            'resources_spam'=>$spam,
            'resources_total'=>$total,

            'userstotal'=>$total_users,
            'usersvolunteer'=>$volunteer_count,
            'usersadmin'=>$admin_count,

            'tweetsverified'=>$count_verified,
            'tweetspending'=>$count_pending,
            'tweetsinadequate'=>$count_inadequate,
            'tweetstotal'=>$total_tweets,


        ]);
    }

    public function terms(){
        return view('dashboard.home.terms');

    }
    public function privacy(){
        return view('dashboard.static.privacy');
    }

    public function referral($referral = '') {
        if($referral == '') {
            return redirect(route('home'));
        }

        $user = User::where('referral_link', $referral)->first();
        if(!$user) {
            return redirect(route('home'));
        }


        if(Auth::check()) {
            if(auth()->user()->id == $user->id) {
                notify()->info('Looks like you\'re testing your own referral link. That\'s good, it works, yay! Now, share it with other people!', 'Kya re? Testing ah');
                return redirect(route('home'));
            }
        } else {
            $user->increment('referrals');
            $user->update();

            $ip = request()->ip();
            $ref = array(
                'user_id' => $user->id,
                'referral_link' => $referral,
                'referrer_ip' => $ip,
            );

            Referral::create($ref);
            notify()->info('We thank them for bringing you and '.$user->referrals.' people here! Please read the "How to" section to know how to use this tool effectively', 'Isn\'t '.$user->name.' awesome?');
            activity()->log('Referral Create: New Referral User created');
            return redirect(route('home'));
        }
    }

    public function view($id = '') {
        if($id == '') {
            notify()->error('You were trying to view a resource, but the ID was not passed. ', 'Whoops');
            return redirect(route('home'));
        } else {
			$resource = Resource::find($id);
			if(!$resource) {
			    notify()->error('The resource you are trying to view is not available', 'Whoops');
			    return redirect(route('home'));
			}
			$comments = $resource->comments;
            return view('dashboard.home.view', [
                'resource' => $resource,
                'comments' => $comments
            ]);
        }


    }

    public function add_comment(Request $request ,$id)
    {
        $resource = Resource::find($id);
        $resource->comment($request->comment);
        notify()->success('Your comment posted successfully','Yay!');
        return redirect()->back();
    }
    public function report($id = '') {
        $resource = Resource::find($id);
        if($id == '') {
            notify()->error('Resource ID not passed', 'Whoops');
            return redirect(route('home'));
        } else if(!$resource) {
            notify()->error('The resource you are trying to view is not available', 'Whoops');
            return redirect(route('home'));
        } else {
            return view('dashboard.home.view', [
                'resource' => $resource,
            ]);
        }
    }


    public function store_report(Request $request , $id) {
        $resource = Resource::find($id);

        $create_account = request('create_account');
        if($create_account != null) {
            //Find existing user by that email.
            $existing_user = User::where('email', request('email'))->first();
            if($existing_user) {
                Auth::attempt(['email' => $existing_user->email, 'password' => request('password')]);
                $user = $existing_user;
            } else {
                $request->validate([
                    'name' => 'required|string|max:255',
                    'email' => 'required|string|email|max:255|unique:users',
                    'state' => 'required|string|max:30',
                    'password' => 'required|string|confirmed|min:8',
                ]);

                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'state' => $request->state,
                    'password' => Hash::make($request->password),
                ]);


                $user->assignRole('user');

                event(new Registered($user));

                Auth::login($user);
                $details = [
                    'to' => $user->email,
                    'name' => $user->name,
                ];
                // Mail::to($user->email)->send(new WelcomeEmail($user->name));
                WelcomeMailJob::dispatch($details)->delay(now()->addSeconds(5));

            }
        }


        if($request->reason == 1 || $request->reason == 2 || $request->reason == 3 || $request->reason == 4) {
            $resource->verified = Resource::REFUTED;
            $resource->save();

            notify()->success('Your report was sent. Your effort goes a long way, we hope you find what you\'re looking for', 'Thank you ');
            $superadmins = User::role('superadmin')->get();
            $user = Auth::user();
            notify()->success('Your response were reported to admin');

            foreach ($superadmins as $superadmin) {

                $details = [
                    'to' => $superadmin->email,
                    'reason' => $request->reason,
                    'comment' => $request->comment,
                    'reported_by' => $user->name,
                    'resource' => $resource->title,
                ];
                SendReportJob::dispatch($details)->delay(now()->addSeconds(5));

                // Mail::to($superadmin)->send(new ResourceRefuted());
            }

            activity()->log('Resource Reported: A Resource has been reported captain');
            return redirect(route('home'));

            if(!isset($user)) {
                $user = auth()->user();
            }

            notify()->success('Your report was sent. Your effort goes a long way, we hope you find what you\'re looking for', 'Thank you '.$user->name);

            return redirect(route('home.view', $id));
        } else {
            notify()->error('Some error occured try again', 'Whoops');
            return redirect(route('home.view', $id));
        }
    }

    public function activity() {
        $activities = LogActivity::all();
        // dd($activities);
        return view('dashboard.admin.activity.index')->with('activities', $activities);
    }

    public function mass_export()
    {
        return Excel::download(new Covid19MassExport,'covid19data.xlsx');
    }

    public function status_view()
    {
        return view('dashboard.home.status');
    }

}
