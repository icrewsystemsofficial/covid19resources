<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Models\Districts;
use App\Models\States;
use App\Models\City;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GeographiesController extends Controller
{

    public function admin_districts_index() {
        return view('dashboard.admin.geographies.districts.index', [
            'districts' => Districts::all(),

        ]);
    }

    public function admin_states_index() {
        return view('dashboard.admin.geographies.states.index', [
            'states' => States::all(),

        ]);
    }

    public function admin_cities_index() {
        return view('dashboard.admin.geographies.cities.index', [
            'cities' => City::all(),

        ]);
    }

    public function admin_districts_create() {
        return view('dashboard.admin.geographies.districts.create',[
            'states'=> States::all(),
            
        ]);
    }

    public function admin_states_create() {
        return view('dashboard.admin.geographies.states.create',[
            'states'=> States::all(),
            
        ]);
    }

    public function admin_cities_create() {
        return view('dashboard.admin.geographies.cities.create',[
            'cities'=> City::all(),
            
        ]);
    }

    public function admin_districts_manage($id) {
        return view('dashboard.admin.geographies.districts.manage', [
            'districts' => Districts::find($id),
            'states' => States::all(),
        ]);
    }

    public function admin_states_manage($id) {
        return view('dashboard.admin.geographies.states.manage', [
            'state' => States::find($id),
        ]);
    }

    public function admin_cities_manage($id) {
        return view('dashboard.admin.geographies.cities.manage', [
            'cities' => City::find($id),
        ]);
    }

    public function admin_districts_save(Request $request) {
        $districts = new Districts;
        $state= States::find($request->statedropdown);
        $districts->name = request('districtname');
        $districts->state = $state->name;
        $districts->code = $state->code;

        //$districts->status = request('status');
        $districts->save();

        notify()->success('districts were added', 'Yayy!');
        return redirect(route('admin.geographies.districts.index'));
    }

    public function admin_states_save(Request $request) {
        $states = new States;
        $state= States::find($request->statedropdown);
        $state->name = request('statename');
        $state->code = $state->code;

        //$districts->status = request('status');
        $state->save();

        notify()->success('States were added', 'Yayy!');
        return redirect(route('admin.geographies.states.index'));
    }

    public function admin_cities_save(Request $request) {
        $cities = new City;
        $cities->name = request('cityname');
        $cities->district = request('districtname');
        $cities->state = request('statename');


        //$districts->status = request('status');
        $cities->save();

        notify()->success('Cities were added', 'Yayy!');
        return redirect(route('admin.geographies.cities.index'));
    }

    public function admin_districts_update($id,Request $request) {
        $districts = Districts::find($id);
        $state= States::find($request->statedropdown);
        $districts->state = $state->name;
        $districts->code = $state->code;
        $districts->update();

        notify()->success('Districts Were Updated', 'Yayy!');
        return redirect(route('admin.geographies.districts.index'));
    }

    public function admin_states_update($id,Request $request) {
        $state= States::find($id);
        $state->name = request('statename');
        $state->type = request('statetype'); 
        $state->code = request('statecode');
        $state->capital = request('statecapital');
        $state->districts = request('statedistricts');


        $state->update();

        notify()->success('States Were Updated', 'Yayy!');
        return redirect(route('admin.geographies.states.index'));
    }

    public function admin_cities_update($id,Request $request) {
        $state= States::find($id);
        $state->name = request('statename');
        $state->type = request('statetype'); 
        $state->code = request('statecode');
        $state->capital = request('statecapital');
        $state->districts = request('statedistricts');


        $state->update();

        notify()->success('States Were Updated', 'Yayy!');
        return redirect(route('admin.geographies.states.index'));
    }

    public function admin_districts_delete($id) {

        Districts::find($id)->delete();
        notify()->success('Districts were Deleted', 'Hmmm, okay');
        return redirect(route('admin.geographies.districts.index'));

    }

    public function admin_states_delete($id) {

        Districts::find($id)->delete();
        notify()->success('States were Deleted', 'Hmmm, okay');
        return redirect(route('admin.geographies.states.index'));

        }
}



