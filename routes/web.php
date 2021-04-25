<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\Admin\FAQ;
use App\Http\Controllers\Dashboard\Volunteers;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\MissionsController;
use App\Http\Controllers\Dashboard\UserEditController;
use App\Http\Controllers\Dashboard\Admin\UserController;
use App\Http\Controllers\Dashboard\Admin\AccessController;
use App\Http\Controllers\Dashboard\Admin\TwitterController;
use App\Http\Controllers\Dashboard\Admin\CategoryController;
use App\Http\Controllers\Dashboard\Admin\ResourceController;
use App\Http\Controllers\Dashboard\Admin\GeographiesController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/r/{referral?}', [HomeController::class, 'referral'])->name('generate.referrallink');

Route::get('/view/{id?}', [HomeController::class, 'view'])->name('home.view');
Route::get('/report/{id?}', [HomeController::class, 'report'])->name('home.report');
Route::post('/submit-report/{id?}', [HomeController::class, 'store_report'])->name('home.submit.report');
Route::get('/edit-profile', [UserEditController::class, 'edit'])->name('home.profile.edit');
Route::put('/user', [UserEditController::class, 'update'])->name('home.profile.save');

Route::get('/about', [HomeController::class, 'about'])->name('home.about');

Route::get('/location', function() {
    Cache::put('location', 'TN', now()->addHours(1));
});

Route::get('/location/get', function() {
    dd(Cache::get('location'));
});


Route::middleware(['auth'])->group(function () {
    //All users using the routes below these, SHOULD
    //have logged in.

    Route::prefix('volunteer')->group(function () {
        Route::get('/', [Volunteers::class, 'index'])->name('home.volunteers.index');
        Route::get('/test', [Volunteers::class, 'test']);
        Route::get('/missions', [Volunteers::class, 'getAllMissions']);
    });

    Route::prefix('mission')->group(function () {
        Route::get('/', [MissionsController::class, 'index'])->name('home.mission.index');
        //Using UUID because users should not "guess" the next mission IDs,
        //But still, other users should be able to validate someone else's missions.
        Route::get('/view/{uuid}', [MissionsController::class, 'view'])->name('home.mission.view');
    });


    Route::prefix('admin')->group(function () {
        Route::get('/faq', [FAQ::class, 'admin_index'])->name('admin.faq.index');
        Route::get('/faq/create', [FAQ::class, 'admin_create'])->name('admin.faq.create');
        Route::post('/faq/create/new', [FAQ::class, 'admin_save'])->name('admin.faq.save');
        Route::get('/faq/{id}/manage', [FAQ::class, 'admin_manage'])->name('admin.faq.manage');
        Route::post('/faq/{id}/update', [FAQ::class, 'admin_update'])->name('admin.faq.update');
        Route::get('/faq/{id}/delete', [FAQ::class, 'admin_delete'])->name('admin.faq.delete');


        Route::get('/resources', [ResourceController::class, 'admin_index'])->name('admin.resources.index');
        Route::get('/resources/create', [ResourceController::class, 'admin_create'])->name('admin.resources.create');
        Route::post('/resources/create/new', [ResourceController::class, 'admin_save'])->name('admin.resources.save');
        Route::get('/resources/{id}/manage', [ResourceController::class, 'admin_manage'])->name('admin.resources.manage');
        Route::post('/resources/{id}/update', [ResourceController::class, 'admin_update'])->name('admin.resources.update');
        Route::get('/resources/{id}/delete', [ResourceController::class, 'admin_delete'])->name('admin.resources.delete');


        Route::get('/categories', [CategoryController::class, 'admin_index'])->name('admin.categories.index');
        Route::get('/categories/create', [CategoryController::class, 'admin_create'])->name('admin.categories.create');
        Route::post('/categories/create/new', [CategoryController::class, 'admin_save'])->name('admin.categories.save');
        Route::get('/categories/{id}/manage', [CategoryController::class, 'admin_manage'])->name('admin.categories.manage');
        Route::post('/categories/{id}/update', [CategoryController::class, 'admin_update'])->name('admin.categories.update');
        Route::get('/categories/{id}/delete', [CategoryController::class, 'admin_delete'])->name('admin.categories.delete');

        Route::get('/geographies/districts', [GeographiesController::class, 'admin_districts_index'])->name('admin.geographies.districts.index');
        Route::get('/geographies/districts/create', [GeographiesController::class, 'admin_districts_create'])->name('admin.geographies.districts.create');
        Route::post('/geographies/districts/create/new', [GeographiesController::class, 'admin_districts_save'])->name('admin.geographies.districts.save');
        Route::get('/geographies/districts/{id}/manage', [GeographiesController::class, 'admin_districts_manage'])->name('admin.geographies.districts.manage');
        Route::post('/geographies/districts/{id}/update', [GeographiesController::class, 'admin_districts_update'])->name('admin.geographies.districts.update');
        Route::get('/geographies/districts/{id}/delete', [GeographiesController::class, 'admin_districts_delete'])->name('admin.geographies.districts.delete');

        Route::get('/geographies/states', [GeographiesController::class, 'admin_states_index'])->name('admin.geographies.states.index');
        Route::get('/geographies/states/create', [GeographiesController::class, 'admin_states_create'])->name('admin.geographies.states.create');
        Route::post('/geographies/states/create/new', [GeographiesController::class, 'admin_states_save'])->name('admin.geographies.states.save');
        Route::get('/geographies/states/{id}/manage', [GeographiesController::class, 'admin_states_manage'])->name('admin.geographies.states.manage');
        Route::post('/geographies/states/{id}/update', [GeographiesController::class, 'admin_states_update'])->name('admin.geographies.states.update');
        Route::get('/geographies/states/{id}/delete', [GeographiesController::class, 'admin_states_delete'])->name('admin.geographies.states.delete');

        Route::get('/geographies/cities', [GeographiesController::class, 'admin_cities_index'])->name('admin.geographies.cities.index');
        Route::get('/geographies/cities/create', [GeographiesController::class, 'admin_cities_create'])->name('admin.geographies.cities.create');
        Route::post('/geographies/cities/create/new', [GeographiesController::class, 'admin_cities_save'])->name('admin.geographies.cities.save');
        Route::get('/geographies/cities/{id}/manage', [GeographiesController::class, 'admin_cities_manage'])->name('admin.geographies.cities.manage');
        Route::post('/geographies/cities/{id}/update', [GeographiesController::class, 'admin_cities_update'])->name('admin.geographies.cities.update');
        Route::get('/geographies/cities/{id}/delete', [GeographiesController::class, 'admin_cities_delete'])->name('admin.geographies.cities.delete');


        Route::prefix('users')->group(function () {
            Route::get('/',[UserController::class,'admin_user_index'])->name('admin.user.index');
            Route::get('/create',[UserController::class,'admin_user_create'])->name('admin.user.create');
            Route::post('/store',[UserController::class,'admin_user_store'])->name('admin.user.store');
            Route::get('{id}/edit',[UserController::class,'admin_user_edit'])->name('admin.user.edit');
            Route::post('/{id}/update',[UserController::class,'admin_user_update'])->name('admin.user.update');
            Route::get('/{id}/delete',[UserController::class,'admin_user_destory'])->name('admin.user.delete');
        });

        Route::prefix('access-control')->group(function () {
            Route::get('/',[AccessController::class,'admin_roles_perms_index'])->name('accesscontrol.index');
            Route::post('/add-role',[AccessController::class,'admin_roles_perms_store'])->name('accesscontrol.store');
            Route::get('{id}/edit-role',[AccessController::class,'admin_roles_perms_manage'])->name('accesscontrol.edit');
            Route::post('{id}/update-role',[AccessController::class,'admin_roles_perms_update'])->name('accesscontrol.update');
            Route::get('{id}/delete-role',[AccessController::class,'admin_roles_perms_destroy'])->name('accesscontrol.delete');
            Route::get('cache-clear/',[AccessController::class,'clearCache'])->name('accesscontrol.cacheclear');
        });

        Route::get('/tweets', [TwitterController::class, 'index'])->name('admin.twitter.index');
        Route::get('/tweets/{id}/manage', [TwitterController::class, 'manage'])->name('admin.twitter.manage');
        Route::post('/tweets/{id}/update', [TwitterController::class, 'update'])->name('admin.twitter.update');
        Route::get('/tweet/{id}/convert', [TwitterController::class, 'convert'])->name('admin.twitter.convert');
        Route::post('/tweet/{id}/convert/save', [TwitterController::class, 'convert_save'])->name('admin.twitter.convert.save');
        Route::get('/tweets/{id}/delete', [TwitterController::class, 'delete'])->name('admin.twitter.delete');


        Route::get('/activity',[HomeController::class,'activity'])->name('activity.log');
    });


});



Route::get('/json', function() {
    $coords = Http::get('https://www.gps-coordinates.net/api/chennai');
    $data = $coords->json();
    $data = (object) $data;
    if($data->responseCode == 200) {
        $coordinates = $data->latitude.','.$data->longitude;
    } else {
        // $coordinates = $this->faker->latitude().','.$this->faker->longitude();
        $coordinates = $data;
    }

    echo $coordinates;

    // if($coords->response->responseCode == 200) {
    //     echo "success";
    // }
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
