<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class DarkmodeController extends Controller
{
    public function toggle(Request $request)
    {   
        // dd($request->all());
        $mode = $request->mode;
        Cache::put('key', $mode, now()->addHours(2));
        return redirect()->back();
    }
}
