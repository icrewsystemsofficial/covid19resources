<?php

use Illuminate\Http\Request;
use App\Http\Controllers\API\States;
use App\Http\Controllers\API\Twitter;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Location;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function () {
    Route::get('/districts/{code?}', [States::class, 'getDistricts']);
    Route::get('/cities/{state?}', [States::class, 'getCities']);
    Route::get('/currentlocation', [Location::class, 'currentLocation']);
    Route::get('/currentlocation/update/{code}', [Location::class, 'currentLocation_update']);
    Route::get('/twitter', [Twitter::class, 'index']);
});
