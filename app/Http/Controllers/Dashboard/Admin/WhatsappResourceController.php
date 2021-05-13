<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Whatsapp;
use App\Models\Resource;
use App\Models\Category;
use App\Models\States;



class WhatsappResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('dashboard.admin.whatsapp.index',[
            'whatsapp' => Whatsapp::all(),
        ]);
    }

    public function manage($id) {

        $whatsapp = Whatsapp::find($id);
        if(!$whatsapp) {
            notify()->error('The record with the given parameters were not found', 'Whoops');
            return redirect(route('admin.whatsapp.index'));
        }



        return view('dashboard.admin.whatsapp.manage', [
            'whatsapp' => $whatsapp,
            'categories' => Category::where('status', 1)->get(),
            'states' => States::all(),
        ]);
    }

    public function update() {
        dd(request()->input());
    }

    public function convert_save($id) {
        $whatsapp = Whatsapp::find($id);
        if(!$whatsapp) {
            notify()->error('Tweet with given parameters were not found', 'Whoops');
            return redirect(route('admin.twitter.index'));
        }

        // dd(request()->input());
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

        $resource->whatsapp_id = $whatsapp->id;

        $city = City::where('name', request('city'))->first();
        if(!$city) {
            $resource->city = '* Unknown';
            $resource->district = '* Unknown';
            $resource->state = request('state');
        } else {
            $resource->city = $city->name;
            $resource->district = $city->district;
            $resource->state = $city->state;
        }

        $resource->landmark = request('landmark');
        $resource->save();

        notify()->success('Resource was successfully added', 'Yayy!');
        activity()->log('Resource: '.$resource->name. ' resource had created');
        return redirect(route('admin.whatsapp.manage', $whatsapp->id));
    }

    public function delete($id) {
        Whatsapp::find($id)->delete();
        notify()->success('Message was successfully deleted', 'Hmmm okay');
        activity()->log('Whatsapp: Message was successfully deleted');
        return redirect(route('admin.whatsapp.index'));
    }
}
