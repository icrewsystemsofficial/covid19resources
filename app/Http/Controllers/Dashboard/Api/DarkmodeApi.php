<?php

namespace App\Http\Controllers\Dashboard\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;

class DarkmodeApi extends Controller
{
    public function toggle(Request $request)
    {   
        // dd($request->all());
        $mode = $request->mode;
        Cache::put('key', $mode, now()->addHours(2));
        return redirect()->back();
    }
}
