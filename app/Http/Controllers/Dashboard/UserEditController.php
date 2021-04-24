<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserEditController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function edit(User $user)
    {
        return view('dashboard.home.editUser', [
            'user' => $user
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
        $validated_inputs['password'] = bcrypt($validated_inputs['password']);
        $user->update($validated_inputs);
        notify()->success('User Profile has been successfully edited', 'Hooray');
        return redirect(route('home'));
    }
}
