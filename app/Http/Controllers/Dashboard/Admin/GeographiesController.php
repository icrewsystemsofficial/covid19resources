<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Models\Districts;
use App\Models\States;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GeographiesController extends Controller
{

    public function admin_districts_index() {
        return view('dashboard.admin.geographies.districts.index', [
            'districts' => Districts::all(),

        ]);
    }

    public function admin_districts_create() {
        return view('dashboard.admin.geographies.districts.create',[
            'states'=> States::all(),
            
        ]);
    }

    public function admin_district_manage($id) {
        return view('dashboard.admin.districts.manage', [
            'geographies' => geographies::find($id),
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

    public function admin_update($id) {
        $geographies = geographies::find($id);
        $geographies->name = request('name');
        $geographies->description = request('description');
        $geographies->status = request('status');
        $geographies->update();

        notify()->success('geographies was updated', 'Yayy!');
        return redirect(route('admin.geographies.index'));
    }

    public function admin_delete($id) {

        geographies::find($id)->delete();
        notify()->success('geographies was deleted', 'Hmmm, okay');
        return redirect(route('admin.geographies.index'));

    }
}
