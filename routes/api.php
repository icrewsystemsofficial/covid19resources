<?php

use Illuminate\Http\Request;
use App\Http\Controllers\API\States;
use App\Http\Controllers\API\Twitter;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Location;
use App\Http\Controllers\API\StatsAPI;
use App\Http\Controllers\API\MissionAPI;
use App\Http\Controllers\API\ScheduleRunner;
use App\Http\Controllers\API\SearchFilterController;
use App\Http\Controllers\API\WhatsappAPI;
use App\Http\Controllers\Dashboard\DarkmodeController;

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
    Route::get('/states', [States::class, 'getStates']);
    Route::get('/districts/{code?}', [States::class, 'getDistricts']);
    Route::get('/cities/{state?}', [States::class, 'getCities']);
    Route::get('/currentlocation', [Location::class, 'currentLocation']);
    Route::get('/currentlocation/update/{code}', [Location::class, 'currentLocation_update']);
    Route::get('/twitter', [Twitter::class, 'index']);
    Route::get('/twitter/getstats', [Twitter::class, 'getstats']);

    Route::get('/tweet/change-status/{id}/{status}', [Twitter::class, 'change_status']);
    Route::get('/tweets/{id}/delete', [Twitter::class, 'delete_tweet']);
    Route::get('/tweet/autoflag', [Twitter::class, 'autoflag']);

    Route::get('/scheduleRun', [ScheduleRunner::class, 'run']);
    Route::get('/scheduleList', [ScheduleRunner::class, 'list']);
    Route::get('/scheduleTweet', [ScheduleRunner::class, 'tweet']);

    Route::get('/mission/changeStatus/{id}/{status}', [MissionAPI::class, 'changeStatus']);
    Route::get('/mission/completedCount/{id}/{status}', [MissionAPI::class, 'completedCount']);
    Route::get('/mission/getstats', [MissionAPI::class, 'getstats']);

    Route::get('/stats/trend/dataInput', [StatsAPI::class, 'dataInput']);

    Route::get('/search/resource/{query?}',[SearchFilterController::class, 'resource_search_filter'])->name('search.filter');
    Route::get('/search/twitter/{query?}',[SearchFilterController::class, 'twitter_search_filter'])->name('search.filter.twitter');
    Route::get('/search/n/{terms?}', [SearchFilterController::class, 'search']);

    Route::get('/toggle-mode/{mode?}',[DarkmodeController::class,'toggle']);

    Route::prefix('whatsapp')->group(function () {
        Route::get('/', [WhatsappAPI::class, 'index'])->name('api.whatsapp.index');
        Route::get('/stats', [WhatsappAPI::class, 'stats'])->name('api.whatsapp.stats');

        Route::get('/whatsapp/change-status/{id}/{status}', [WhatsappAPI::class, 'change_status']);
        Route::get('/whatsapp/{id}/delete', [WhatsappAPI::class, 'delete_whatsapp_resource']);



        Route::post('/create', [WhatsappAPI::class, 'create'])->name('api.whatsapp.create');

    });

});
