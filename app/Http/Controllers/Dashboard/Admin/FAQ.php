<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Models\States;
use App\Models\Districts;
use Illuminate\Http\Request;
use App\Models\FAQ as ModelsFAQ;
use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class FAQ extends Controller
{
    public function admin_index() {
        return view('dashboard.admin.faq.index')->with('faqs', ModelsFAQ::all());
    }

    public function admin_create() {
        return view('dashboard.admin.faq.create', [
            'categories' => Category::where('status', 1)->get(),
            'states' => States::all(),
            'districts' => Districts::all(),
        ]);
    }

    public function admin_save() {

        $state = Districts::where('name', request('district'))->first();

        $faq = new ModelsFAQ;
        $faq->title = request('title');
        $faq->description = request('description');
        $faq->state = $state->state;
        $faq->district = request('district');
        $faq->categories = json_encode(request('categories'));
        $faq->author_id = auth()->user()->id;
        $faq->status = request('status');
        $faq->save();

        $activity = new Activity;
        $activity->user_id = Auth::user()->id;
        $activity->activity = "Added a FAQ";
        $activity->save();

        notify()->success('FAQ was added', 'Yayyy');
        activity()->log('Admin FAQ: '.$faq->title.' was added');
        return redirect(route('admin.faq.index'));
    }


    public function admin_manage($id) {
        if($id == '') {
            return redirect(route('admin.faq.index'));
        }
        return view('dashboard.admin.faq.manage', [
            'categories' => Category::where('status', 1)->get(),
            'faq' => ModelsFAQ::find($id),
            'states' => States::all(),
            'districts' => Districts::all(),
        ]);
    }

    public function admin_update($id) {

        $state = Districts::where('name', request('district'))->first();

        $faq = ModelsFAQ::find($id);
        $faq->title = request('title');
        $faq->description = request('description');
        $faq->state = $state->state;
        $faq->district = request('district');
        $faq->categories = json_encode(request('categories'));
        $faq->author_id = auth()->user()->id;
        $faq->status = request('status');
        $faq->update();

        $activity = new Activity;
        $activity->user_id = Auth::user()->id;
        $activity->activity = "Updated a FAQ";
        $activity->save();


        notify()->success('FAQ was updated', 'Yayyy');
        activity()->log('Admin FAQ: '.$faq->title.' was updated');
        return redirect(route('admin.faq.index'));
    }

    public function admin_delete($id) {
        ModelsFAQ::find($id)->delete();

        $activity = new Activity;
        $activity->user_id = Auth::user()->id;
        $activity->activity = "Deleted a FAQ";
        $activity->save();

        notify()->success('FAQ was deleted', 'Hmmm, okay');
        activity()->log('Admin FAQ: FAQ was deleted');
        return redirect(route('admin.faq.index'));
    }


}
