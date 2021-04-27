<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{

    public function admin_index() {
        return view('dashboard.admin.categories.index', [
            'categories' => Category::all(),
        ]);
    }

    public function admin_create() {
        return view('dashboard.admin.categories.create');
    }

    public function admin_manage($id) {
        return view('dashboard.admin.categories.manage', [
            'category' => Category::find($id),
        ]);
    }

    public function admin_save() {
        $category = new Category;
        $category->name = request('name');
        $category->description = request('description');
        $category->status = request('status');
        $category->save();        
        notify()->success('Category was added', 'Yayy!');
        activity()->log('Admin Category: '.$category->name.' was added');
        return redirect(route('admin.categories.index'));
    }

    public function admin_update($id) {
        $category = Category::find($id);
        $category->name = request('name');
        $category->description = request('description');
        $category->status = request('status');
        $category->update();
        notify()->success('Category was updated', 'Yayy!');
        activity()->log('Admin Category: '.$category->name.' was updated');
        return redirect(route('admin.categories.index'));
    }

    public function admin_delete($id) {

        Category::find($id)->delete();
        notify()->success('Category was deleted', 'Hmmm, okay');
        activity()->log('Admin Category: Category was deleted');
        return redirect(route('admin.categories.index'));

    }
}
