<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Districts;
use App\Models\FAQ;
use App\Models\States;
use Illuminate\Http\Request;

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


        return view('dashboard.home.home', [
            'faqs' => $faq,
            'states' => States::all(),
            'districts' => Districts::all(),
        ]);
    }
}
