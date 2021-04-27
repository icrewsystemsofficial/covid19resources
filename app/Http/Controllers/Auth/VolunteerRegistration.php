<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\States;
use Illuminate\Support\Str;
use App\Jobs\WelcomeMailJob;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Cookie;
use App\Providers\RouteServiceProvider;
use App\Jobs\Volunteers\SendWelcomeMail;

class VolunteerRegistration extends Controller
{
    public function index() {
        return view('auth.register_volunteers', [
            'states' => States::all(),
            // 'districts' => Districts::all(),
        ]);
    }

    public function register(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'state' => 'required|string|max:30',
            'password' => 'required|string|confirmed|min:8',
            // 'g-recaptcha-response' => 'required|captcha'
        ]);



        // generate a referral link for new user
        $kebab = Str::kebab($request->name);
        $randnum = rand(pow(10, 5-1), pow(10, 5)-1);
        $reflink = $kebab.'-'.$randnum;


        // create new user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'state' => $request->state,
            'password' => Hash::make($request->password),
            'referral_link' => $reflink
        ]);


        $user->assignRole('volunteer');

        event(new Registered($user));

        Auth::login($user);

        SendWelcomeMail::dispatch($user)->delay(now()->addMinutes(2));

        return redirect(RouteServiceProvider::HOME);
    }
}
