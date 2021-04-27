<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Models\City;
use App\Models\States;
use App\Models\Category;
use App\Models\Resource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ResourceController extends Controller
{
    public function admin_index() {
        return view('dashboard.admin.resources.index', [
            'resources' => Resource::all(),
        ]);
    }

    public function admin_create() {
        return view('dashboard.admin.resources.create', [
            'categories' => Category::where('status', 1)->get(),
            'states' => States::all(),
        ]);
    }

    public function admin_manage($id) {
        return view('dashboard.admin.resources.manage', [
            'resource' => Resource::find($id),
            'categories' => Category::where('status', 1)->get(),
            'states' => States::all(),
            'users' => User::where('accepted', 1)->get(),
        ]);
    }

    public function admin_save(Request $request) {

        $request->validate([
            'g-recaptcha-response' => 'required|captcha'
        ],[
            'g-recaptcha-response.required' => 'Please verify that you are not a robot.',
            'g-recaptcha-response.captcha' => 'Captcha error! try again later or contact site admin.',
        ]);

        $resource = new Resource;
        $resource->category = request('category');
        $resource->title = request('name');
        $resource->body = request('body');
        $resource->phone = request('phone');
        $resource->url = request('url');
        $resource->author_id = request('author_id');
        $resource->verified = request('status');

        if(request('status') == 1) {
            $resource->verified_by = request('author_id');
        }

        $city = City::where('name', request('city'))->first();
        $resource->city = $city->name;
        $resource->district = $city->district;
        $resource->state = $city->state;
        $resource->hasAddress = 1;
        $resource->landmark = request('landmark');
        $resource->save();
        notify()->success('Resource was added', 'Yayy!');
        return redirect(route('admin.resources.index'));
    }

    public function admin_update($id) {

        // dd(request()->input());
        $resource = Resource::find($id);
        $resource->category = request('category');
        $resource->title = request('name');
        $resource->body = request('body');
        $resource->phone = request('phone');
        $resource->url = request('url');
        $resource->author_id = request('author_id');
        $resource->verified = request('status');

        if(request('status') == 1) {
            $resource->verified_by = request('author_id');
        }

        $city = City::where('name', request('city'))->first();
        $resource->city = $city->name;
        $resource->district = $city->district;
        $resource->state = $city->state;

        $resource->landmark = request('landmark');
        $resource->update();

        notify()->success('Resource was updated', 'Yayy!');
        return redirect(route('admin.resources.index'));
    }

    public function admin_delete($id) {

        Resource::find($id)->delete();

        notify()->success('Resource was deleted', 'Hmmm, okay');
        return redirect(route('admin.resources.index'));

    }
}
