<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Districts;
use App\Models\States;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeEmail;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {    
        
         $referrer = User::find($request->query('uuid'));     
        if( $request->hasCookie('referral') && $request->query('uuid')) {

            return view('auth.register', [
                'states' => States::all(),
                'districts' => Districts::all(),
                'uuid' => $referrer
            ]);

         } else {

            return view('auth.register', [
                'states' => States::all(),
                'districts' => Districts::all(),
                'uuid' => $referrer
            ]);
         }
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {   
        // dd($request->all());
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'state' => 'required|string|max:30',
            'password' => 'required|string|confirmed|min:8',
        ]);

        
        $referrer = User::find($request->uuid);
         if($referrer) {
            $referrer->increment('referral_signups');
            $referrer->save();
        }

        // generate a referral link for new user
        $kebab = Str::kebab($request->name);
        $randnum = rand(pow(10, 5-1), pow(10, 5)-1);
        $reflink = $kebab.'-'.$randnum;


        // get referral link via cookie
        $referred_by = Cookie::get('referral');

        // create new user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'state' => $request->state,
            'password' => Hash::make($request->password),
            'referred_by' => $referred_by,
            'referral_link' => $reflink 
        ]);
        

        event(new Registered($user));

        Auth::login($user);

        Mail::to($user->email)->send(new WelcomeEmail($user->name));

        return redirect(RouteServiceProvider::HOME);
    }
}
