<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\FAQ;
use App\Models\States;
use App\Models\Resource;
use App\Models\Districts;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Activity;

class HomeController extends Controller
{
    public function __construct() {
        $currentlocation = \App\Http\Controllers\API\Location::locationDisplay();
        $this->currentlocation = $currentlocation;
    }

    public function index() {

        if(request('search')) {
            $faq = FAQ::where('state', $this->currentlocation->name)->paginate(5);
        } else {
            $faq = FAQ::where('state', $this->currentlocation->name)
            ->orWhere('title', '%LIKE%', request('search'))
            // ->orWhere('description', '%LIKE%', request('search'))
            ->paginate(5)
            ->appends(['search' => request('search')]);
        }
        $activity = Activity::with(array('user'))->orderBy('updated_at', 'desc')->take(5)->get();

        return view('dashboard.home.home', [
            'activity' => $activity,
            'faqs' => $faq,
            'states' => States::all(),
            'districts' => Districts::all(),
            'resources' => Resource::where('state', $this->currentlocation->name)->get(),
        ]);
    }

    public function view($id = '') {

        $resource = Resource::find($id);
        if($id == '') {
            notify()->error('Resource ID not passed', 'Whoops');
            return redirect(route('home'));
        } else if(!$resource) {
            notify()->error('The resource you are trying to view is not available', 'Whoops');
            return redirect(route('home'));
        } else {



            return view('dashboard.home.view', [
                'resource' => $resource,
            ]);
        }


    }

    public function report($id = '') {
        $resource = Resource::find($id);
        if($id == '') {
            notify()->error('Resource ID not passed', 'Whoops');
            return redirect(route('home'));
        } else if(!$resource) {
            notify()->error('The resource you are trying to view is not available', 'Whoops');
            return redirect(route('home'));
        } else {
            return view('dashboard.home.view', [
                'resource' => $resource,
            ]);
        }
    }
// http://covid19resources.test/admin/resources/44/manage

    public function store_report(Request $request , $id) {
        $resource = Resource::find($id); 
        // dd($request->all());
        if($request->reason == 1 || $request->reason == 2 || $request->reason == 3 || $request->reason == 4) {
            $resource->verified = 2;
            $resource->save();
            notify()->success('Your response were reported to admin');
            return redirect(route('home'));
        } else {
            notify()->error('Some error occured try again', 'Whoops');
            return redirect(route('home'));
        }
    }
}
