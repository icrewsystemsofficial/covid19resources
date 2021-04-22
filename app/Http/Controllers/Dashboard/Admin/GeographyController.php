<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Models\Districts;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class geographyController extends Controller
{

    public function admin_index() {
        return view('dashboard.admin.geography.index', [
            'geography' => Districts::all(),
        ]);
    }

    public function admin_create() {
        return view('dashboard.admin.geography.create');
    }

    public function admin_manage($id) {
        return view('dashboard.admin.geography.manage', [
            'geography' => geography::find($id),
        ]);
    }

    public function admin_save() {
        $geography = new geography;
        $geography->name = request('name');
        $geography->description = request('description');
        $geography->status = request('status');
        $geography->save();

        notify()->success('geography was added', 'Yayy!');
        return redirect(route('admin.geography.index'));
    }

    public function admin_update($id) {
        $geography = geography::find($id);
        $geography->name = request('name');
        $geography->description = request('description');
        $geography->status = request('status');
        $geography->update();

        notify()->success('geography was updated', 'Yayy!');
        return redirect(route('admin.geography.index'));
    }

    public function admin_delete($id) {

        geography::find($id)->delete();
        notify()->success('geography was deleted', 'Hmmm, okay');
        return redirect(route('admin.geography.index'));

    }
}
