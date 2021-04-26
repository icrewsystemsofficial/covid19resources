<?php

namespace App\Http\Controllers\Dashboard;

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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Mail\ResourceRefuted;
use App\Models\Activity;
use Illuminate\Support\Facades\Mail;


use Spatie\Activitylog\Models\Activity as LogActivity;

class HomeController extends Controller
{
    public function __construct() {
        $currentlocation = \App\Http\Controllers\API\Location::locationDisplay();
        $this->currentlocation = $currentlocation;
    }

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

        $city = City::where('name', request('city'))->first();
        $resource->city = $city->name;
        $resource->district = $city->district;
        $resource->state = $city->state;
        $resource->hasAddress = 1;
        $resource->landmark = request('landmark');
        $resource->save();

        // dd($resource);

        return redirect(route('home.view', $resource->id));
    }

    public function index() {

        if(request('search')) {
            $faq = FAQ::where('state', $this->currentlocation->name)->paginate(5);
        } else {
            $faq = FAQ::where('state', $this->currentlocation->name)
            ->orWhere('title', '%LIKE%', request('search'))
            // ->orWhere('description', '%LIKE%', request('search'))
            ->paginate(5)
            ->appends(['search' => request('search')]);
        }

        $resources = Resource::
                        where('state', $this->currentlocation->name)
                        ->get();
        return view('dashboard.home.home', [
            'faqs' => $faq,
            'states' => States::all(),
            'districts' => Districts::all(),
            'resources' => $resources,
        ]);
    }

    public function about() {
        return view('dashboard.static.about');
    }

    public function how_to() {
        return view('dashboard.static.howto');
    }
    
    public function terms(){
        return view('dashboard.home.terms');
    }

    public function referral($referral = '') {
        if($referral == '') {
            return redirect(route('home'));
        }

        $user = User::where('referral_link', $referral)->first();
        if(!$user) {
            return redirect(route('home'));
        }


        if(auth()) {
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
            return redirect(route('home'));
        }
    }

    public function view($id = '') {

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

                Mail::to($user->email)->send(new WelcomeEmail($user->name));
            }
        }


        if($request->reason == 1 || $request->reason == 2 || $request->reason == 3 || $request->reason == 4) {
            $resource->verified = Resource::REFUTED;
            $resource->save();

            notify()->success('Your report was sent. Your effort goes a long way, we hope you find what you\'re looking for', 'Thank you '.$user->name);
            $superadmins = User::role('superadmin')->get();
            notify()->success('Your response were reported to admin');
            foreach ($superadmins as $superadmin) {
                Mail::to($superadmin)->send(new ResourceRefuted());
            }
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

}
