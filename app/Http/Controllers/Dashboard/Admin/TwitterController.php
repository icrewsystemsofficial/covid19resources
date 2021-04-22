<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Models\States;
use App\Models\Twitter;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TwitterController extends Controller
{
    public function index() {
        return view('dashboard.admin.twitter.index', [
            'tweets' => Twitter::all(),
        ]);
    }

    public function manage($id) {
        return view('dashboard.admin.twitter.manage', [
            'tweet' => Twitter::find($id),
            'categories' => Category::where('status', 1)->get(),
            'states' => States::all(),
        ]);
    }

    public function update() {
        dd(request()->input());
    }
}
