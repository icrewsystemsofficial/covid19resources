<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;

class UserEditController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function edit()
    {
        return view('dashboard.home.editUser', [
            'user' => auth()->user()
        ]);

    }

    public function update(User $user)
    {
        // dd(request()->all());
        $validated_inputs = request()->validate([
                'name' => 'string|max:255',
                'email' => 'string|email|max:255',
                'password' => 'nullable|string|confirmed|min:8',
                'phone_number' => 'digits:10'
        ]);
        if (request('available_for_mission')) {
            $available_for_mission = 1;
            activity()->log('Profile Edit: Marked as available for mission');
        } else {
            $available_for_mission = 0;
        }
        $validated_inputs['available_for_mission'] = $available_for_mission;
        if ($validated_inputs['password']) {
            $validated_inputs['password'] = bcrypt($validated_inputs['password']);
        } else {
            $validated_inputs = Arr::except($validated_inputs, ['password']);
        }
        User::where('email', $validated_inputs['email'])->update($validated_inputs);
        notify()->success('Your profile was updated successfully', 'Yay!');
        activity()->log('Profile Edit: User Profile got edited');
        return redirect(route('home'));
    }
}
