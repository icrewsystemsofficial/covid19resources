<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Districts;
use App\Models\States;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        return view('dashboard.home.home', [
            'states' => States::all(),
            'districts' => Districts::all(),
        ]);
    }
}
