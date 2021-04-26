<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Models\User;
use App\Models\States;
use App\Models\Districts;
use App\Mail\PointsSystem;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function admin_user_index()
    {
        $users = User::orderby('id','desc')->get();
        $roles = Role::all();


        return view('dashboard.admin.users.index')->with('users',$users)->with('roles',$roles);
    }

    /**
     * Show the form for creating a new resource.
     *
    * @return \Illuminate\Http\Response
     */
    public function admin_user_create()
    {
        $roles = Role::all();
        $states = States::all();
        $districts = Districts::all();
        return view('dashboard.admin.users.create')->with('roles',$roles)->with('states',$states)->with('districts',$districts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *
     */
    public function admin_user_store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => ['required','string', 'max:255'],
            'email' => ['required', 'max:255', 'email', Rule::unique('users')],
            'state' => ['required'],
            'password' => ['required','confirmed','min:8'],
            'accepted' => ['required'],
            'role' => ['required']
        ]);


         $user = new User;
         $user->name = $request->name;
         $user->email = $request->email;
         $user->state = $request->state;
         $user->district = $request->district;
         $user->password = Hash::make($request->password);
         $user->accepted = $request->accepted;

         $kebab = Str::kebab($user->name);
         $randnum = rand(pow(10, 5-1), pow(10, 5)-1);
         $reflink = $kebab.'-'.$randnum;
         $user->referral_link = $reflink;
         $user->save();

         $user->roles()->detach();
         $newrole = Role::find($request->role);
         $user->assignRole($newrole->name);

         notify()->success($request->name .'\'s profile was created successfully.', 'Yay!');
         activity()->log('Profile Create: New Volunteer User Created');

         return redirect(route('admin.user.index'))->with('success','User created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function admin_user_edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        $states = States::all();
        $districts = Districts::all();
        // dd();
        return view('dashboard.admin.users.edit')->with('user',$user)->with('roles',$roles)->with('states',$states)->with('districts',$districts);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function admin_user_update(Request $request, $id)
    {
        // dd($request->all());
        $user = User::where('id','=',$id)->first();

        $request->validate([
            'email' => ['required', 'max:50', 'email', Rule::unique('users')->ignore($user->id)],
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->state = $request->state;
        $user->district = $request->district;
        $user->accepted = $request->accepted;

        User::find($id)->increment('points',$request->points);



        if ($user->points==1) {

            $details =[
                'title' => 'Mail from Icrew-Covid 19 Resource Tracker',
                'body' => 'Your first point as a volunteer. We salute your efforts in such testing times'
            ];

            Mail::to($user->email)->send(new PointsSystem($details));
        }

        elseif ($user->points==500) {

            $details =[
                'title' => 'Mail from Icrew-Covid 19 Resource Tracker',
                'body' => 'Your first point as a volunteer. We salute your efforts in such testing times'
            ];

            Mail::to($user->email)->send(new PointsSystem($details));
        }

        $user->save();

        $user->roles()->detach();
        $newrole = Role::findByName($request->role);
        $user->assignRole($newrole->name);

         notify()->success($request->name .'\'s profile was updated successfully.', 'Yay!');
         activity()->log('Profile Edit: Volunteer User Details got edited');
         return redirect(route('admin.user.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function admin_user_destory($id)
    {
        User::find($id)->delete();
        notify()->success('User\'s account has been deleted', 'Alright!');
        activity()->log('Profile Delete: Volunteer User Profile got deleted');
        return redirect(route('admin.user.index'));
    }


}
