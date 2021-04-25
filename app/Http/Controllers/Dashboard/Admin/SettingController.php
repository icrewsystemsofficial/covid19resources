<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SettingController extends Controller
{

    public function admin_setting_index()
    {   
        $settings = Setting::all();
        return view('dashboard.admin.setting.index')->with('settings',$settings);
    }

    public function admin_setting_create()
    {
        return view('dashboard.admin.setting.create');
    }

    public function admin_setting_store(Request $request)
    {  
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'value' => 'required',
            'core' => 'required'
        ]);

       $setting = new Setting;
       $setting->name = Str::kebab($request->name);
       $setting->description = $request->description;
       $setting->value = Str::kebab($request->value);
       $setting->core = $request->core;
       $setting->save();

       activity()->log('Setting: '.$setting->name.'has been created');
       notify()->success($setting->name.'created successfully','Yay!');
       
       return redirect(route('admin.setting.index'));
    }

    public function admin_setting_edit($id)
    {   
        $setting = Setting::findOrFail($id);
        // dd($setting->name);
        return view('dashboard.admin.setting.edit')->with('setting',$setting);
    }

    public function admin_setting_update(Request $request, $id)
    {
        $setting = Setting::find($id);
        $setting->name = Str::kebab($request->name);
        $setting->description = $request->description;
        $setting->value = Str::kebab($request->value);
        $setting->core = $request->core;
        $setting->save();

        activity()->log('Setting: '.$setting->name.'has been updated');
        notify()->success($setting->name.'successfully updated','Yay!');

        return redirect(route('admin.setting.index'));
    }

    public function admin_setting_delete($id)
    {    
        $setting = Setting::find($id)->name;
        Setting::find($id)->delete();

        activity()->log('Setting: '.$setting.'has been deleted');
        notify()->success($setting.'successfully deleted','Alright');
        
        return redirect(route('admin.setting.index'));
    }
}
