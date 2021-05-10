<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Crowdsourced extends Controller
{
    public function crowdsourced() {
        return view('dashboard.home.crowdsourced.index');
    }
    
    public function helplines() {
        return view('dashboard.home.crowdsourced.helpline');
    }
    
    public function instagram() {
        return view('dashboard.home.crowdsourced.instagram');
    }
    public function websites() {
        return view('dashboard.home.crowdsourced.websites');
    }

}
