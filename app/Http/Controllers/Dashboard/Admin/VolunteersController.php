<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Volunteer;
use Hash;

class VolunteersController extends Controller
{
    public function volunteers_termsandconditions() {

        return view('volunteers.termsandconditions');
    }

    public function volunteers_register(){
        return view('volunteers.register');
    }

    public function volunteers_store(Request $request){

        $request->validate([
            'name' => ['required','string','max:255'],
            'email'=>['required','max:255'],
            'phone'=>['required'],
            'password'=>['required','confirmed','min:8'],
        ]);

        $volunteer = new Volunteer;
        $volunteer->name = $request->name;
        $volunteer->email = $request->email;
        $volunteer->phone = $request->phone;
        $volunteer->password=Hash::make($request->password);
        $volunteer->save();

        notify()->success($volunteer->name .'\'s profile was created successfully.', 'Yay!');
        return redirect(route('volunteers.register'));
    }

    public function volunteers_points(Request $request){
        $volunteer = new Volunteer;
        
    }
}
