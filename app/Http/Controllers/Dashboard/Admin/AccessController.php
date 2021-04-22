<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AccessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function admin_roles_perms_index()
    {
        $roles = Role::all();
        return view('dashboard.admin.access.index')->with('roles',$roles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function admin_roles_perms_create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function admin_roles_perms_store(Request $request)
    {
        // dd($request->all());
        if($request->input('role') == '') {
            notify()->error('Role name cannot be blank', 'Whoops!');
            return redirect()->back();
        }
        $slugged_name = strtolower(str_replace(' ', '-', trim($request->input('role'))));
        $role = Role::where('name', $slugged_name)->first();

        if(!$role) {
            $role = new Role;
            $role->name = $slugged_name;
            $role->save();

        notify()->success('Yay!', 'New role '. $role->name .' was created.');
        return redirect(route('accesscontrol.index'));
        } else {
            notify()->error('Oops!','Role '. $role->name .' already exists.');
            return redirect(route('accesscontrol.index'));
        }
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
    public function admin_roles_perms_manage($id)
    {
        $role = Role::where($id)->get();
        if($role) {
            $permissions = Permission::all();
            return view('admin.accessControl.manage')
            ->with('permissions', $permissions)
            ->with('role', $role);
          } else {
            notify()->error('Role with the given ID was not found', 'Whoops!');
            return redirect(route('accessControl.index'));
          }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function admin_roles_perms_update(Request $request, $id)
    {
        $slugged_name = str_replace(' ', '-', trim($request->input('role')));

        $role = Role::find($id);
        $role->name = $slugged_name;
        $role->save();
  
        $role = Role::find($id);
        $permissions = array();
        foreach($request->input() as $name => $value) {
          if($name == '_token') {
            //It's the CSRF token. Ignore...
          } else if($role->name == $value) {
            //Is a role. Ignore...
          } else {
            $permissions[] = $name;
          }
        }
  
        $role->syncPermissions($permissions);
  
        notify()->success('Role '. $role->name. ' has been modified', 'Yay!');
        return redirect(route('accessControl.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function admin_roles_perms_destroy($id)
    {
        $role = Role::find($id);
        if($role) {
          $role->delete();
          notify()->success('Role has been successfully deleted', 'Alrighty!');
        }
        return redirect(route('accessControl.index'));
    }

    public function clearCache() {
        Artisan::call('cache:clear');
        notify()->success('Application cache has been cleared', 'Alrighty!');
        return redirect(route('accessControl.index'));
      }
}
