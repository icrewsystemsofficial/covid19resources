<?php

use App\Http\Controllers\Dashboard\Admin\AccessController;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\Admin\FAQ;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\Admin\TwitterController;
use App\Http\Controllers\Dashboard\Admin\CategoryController;
use App\Http\Controllers\Dashboard\Admin\ResourceController;
use App\Http\Controllers\Dashboard\Admin\UserController;
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
Route::get('/view/{id?}', [HomeController::class, 'view'])->name('home.view');
Route::get('/report/{id?}', [HomeController::class, 'report'])->name('home.report');

Route::get('/location', function() {
    Cache::put('location', 'TN', now()->addHours(1));
});

Route::get('/location/get', function() {
    dd(Cache::get('location'));
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
        Route::get('{id}/edit-role',[AccessController::class,'admin_roles_perms_edit'])->name('accesscontrol.edit');
        Route::get('{id}/update-role',[AccessController::class,'admin_roles_perms_update'])->name('accesscontrol.update');
        Route::get('{id}/delete-role',[AccessController::class,'admin_roles_perms_destroy'])->name('accesscontrol.update');
    });
  
    Route::get('/tweets', [TwitterController::class, 'index'])->name('admin.twitter.index');
    Route::get('/tweets/{id}/manage', [TwitterController::class, 'manage'])->name('admin.twitter.manage');
    Route::post('/tweets/{id}/update', [TwitterController::class, 'update'])->name('admin.twitter.update');
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
