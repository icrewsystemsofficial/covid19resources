<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Exports\ResourceExport;
use App\Models\City;
use App\Models\States;
use App\Models\Category;
use App\Models\Resource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

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

        if(request('city') == '* All Cities') {
        	$resource->city = request('city');
        	$resource->district = '* All Districts';
		    $resource->state = request('State');
		    $resource->hasAddress = 0;
        } else if(request('city') == '* Unavailable') {
        	$resource->city = request('city');
        	$resource->district = '* Unavailable';
		    $resource->state = request('State');
		    $resource->hasAddress = 0;
        } else {
        	$city = City::where('name', request('city'))->first();

            if($city) {
                $resource->city = $city->name;
                $resource->district = $city->district;
                $resource->state = $city->state;
                $resource->hasAddress = 1;
                $resource->landmark = request('landmark');
            } else {
                //If city is not traceable in the DB
                $resource->city = request('city');
                $resource->district = 'Unknown';
                $resource->state = request('State');
                $resource->hasAddress = 0;
            }
        }

        $resource->save();
        notify()->success('Resource was added', 'Yayy!');
        activity()->log('Admin Resource: '.$resource->title. ' resource had created');
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
        activity()->log('Admin Resource: '.$resource->title. ' resource had updated');
        return redirect(route('admin.resources.index'));
    }

    public function admin_delete($id) {

        Resource::find($id)->delete();

        notify()->success('Resource was deleted', 'Hmmm, okay');
        activity()->log('Admin Resource: Resource has deleted');
        return redirect(route('admin.resources.index'));

    }

    public function admin_resource_export()
    {
        return Excel::download(new ResourceExport,'resources.xlsx');
    }
    public function import(Request $request){
        $this->validate($request, [
            'select_file'  => 'required|mimes:xls,xlsx'
           ]);
      
           $path = $request->file('select_file')->getRealPath();
      
           $data = Excel::load($path)->get();
      
           if($data->count() > 0)
           {
            foreach($data->toArray() as $key => $value)
            {
             foreach($value as $row)
             {
              $insert_data[] = array(
               'id'  => $row['id'],
               'category'   => $row['category'],
               'title'   => $row['title'],
               'body'    => $row['body'],
               'phone'  => $row['phone'],
               'url'   => $row['url'],
               'author_id'    => $row['author_id'],
               'verified'  => $row['verified'],
               'verified_by'   => $row['verified_by'],
               'tweet_id'  => $row['tweet_id'],
               'hasAddress'   => $row['hasAddress'],
               'city'    => $row['city'],
               'district'  => $row['district'],
               'state'   => $row['state'],
               'landmark'   => $row['landmark'],
               'coordinates'    => $row['coordinates'],
               'created_at'  => $row['created_at'],
               'updated_at'   => $row['updated_at'],
              );
             }
            }
      
            if(!empty($insert_data))
            {
             DB::table('resources')->insert($insert_data);
            }
           }
           return back()->with('success', 'Excel Data Imported successfully.');
        
    }
}
