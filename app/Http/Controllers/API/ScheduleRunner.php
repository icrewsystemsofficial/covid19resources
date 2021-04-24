<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;

class ScheduleRunner extends Controller
{
    public function run() {

        //Since we're getting errors while runing cron jobs via cPanel, this
        //is a work around.
        Artisan::call('schedule:run');
        $output = Artisan::output();
        return $output;
    }

    public function list() {
        Artisan::call('schedule:list');
        $output = Artisan::output();
        return $output;
    }
}
