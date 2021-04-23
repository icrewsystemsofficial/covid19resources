<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Models\Districts;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GeographiesController extends Controller
{

    public function admin_index() {
        return view('dashboard.admin.geographies.index', [
            'geographies' => Districts::all(),
        ]);
    }

    public function admin_create() {
        return view('dashboard.admin.geographies.create',[
            'geographies' =>Districts::all(),
        ]);
    }

    public function admin_manage($id) {
        return view('dashboard.admin.geographies.manage', [
            'geographies' => geographies::find($id),
        ]);
    }

    public function admin_save() {
        $geographies = new geographies;
        $geographies->name = request('name');
        $geographies->description = request('description');
        $geographies->status = request('status');
        $geographies->save();

        notify()->success('geographies was added', 'Yayy!');
        return redirect(route('admin.geographies.index'));
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
