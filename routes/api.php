<?php

use Illuminate\Http\Request;
use App\Http\Controllers\API\States;
use App\Http\Controllers\API\Twitter;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Location;
use App\Http\Controllers\API\MissionAPI;
use App\Http\Controllers\API\ScheduleRunner;

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
    Route::get('/twitter/getstats', [Twitter::class, 'getstats']);

    Route::get('/tweet/change-status/{id}/{status}', [Twitter::class, 'change_status']);
    Route::get('/tweets/{id}/delete', [Twitter::class, 'delete_tweet']);
    Route::get('/tweet/autoflag/{id}', [Twitter::class, 'autoflag']);

    Route::get('/scheduleRun', [ScheduleRunner::class, 'run']);
    Route::get('/scheduleList', [ScheduleRunner::class, 'list']);
    Route::get('/scheduleTweet', [ScheduleRunner::class, 'tweet']);

    Route::get('/mission/changeStatus/{id}/{status}', [MissionAPI::class, 'changeStatus']);
    Route::get('/mission/completedCount/{id}/{status}', [MissionAPI::class, 'completedCount']);
});
