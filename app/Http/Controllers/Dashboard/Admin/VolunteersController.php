<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VolunteersController extends Controller
{
    public function volunteers_termsandconditions() {

        return view('volunteers.termsandconditions');
    }

    public function volunteers_register(){
        return view('volunteers.register');
    }
}
