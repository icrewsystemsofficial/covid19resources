<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Resource;

class ResourceController extends Controller
{
    public function admin_index() {
        return view('dashboard.admin.resources.index', [
            'resources' => Resource::all(),
        ]);
    }

    public function admin_create() {
        return view('dashboard.admin.resources.create');
    }

    public function admin_manage($id) {
        return view('dashboard.admin.resources.manage', [
            'resource' => Resource::find($id),
        ]);
    }

    public function admin_save() {
        $category = new Category;
        $category->name = request('name');
        $category->description = request('description');
        $category->status = request('status');
        $category->save();

        notify()->success('Category was added', 'Yayy!');
        return redirect(route('admin.resources.index'));
    }

    public function admin_update($id) {
        $category = Category::find($id);
        $category->name = request('name');
        $category->description = request('description');
        $category->status = request('status');
        $category->update();

        notify()->success('Category was updated', 'Yayy!');
        return redirect(route('admin.resources.index'));
    }

    public function admin_delete($id) {

        Category::find($id)->delete();
        notify()->success('Category was deleted', 'Hmmm, okay');
        return redirect(route('admin.resources.index'));

    }
}
