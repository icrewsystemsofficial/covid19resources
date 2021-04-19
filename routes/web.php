<?php

use App\Http\Controllers\Dashboard\Admin\FAQ;
use App\Http\Controllers\Dashboard\HomeController;
use Illuminate\Support\Facades\Route;

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

Route::prefix('admin')->group(function () {
    Route::get('/faq', [FAQ::class, 'admin_index'])->name('admin.faq.index');
    Route::get('/faq/create', [FAQ::class, 'admin_create'])->name('admin.faq.create');
    Route::post('/faq/create/new', [FAQ::class, 'admin_save'])->name('admin.faq.save');
    Route::get('/faq/{id}/manage', [FAQ::class, 'admin_manage'])->name('admin.faq.manage');
    Route::post('/faq/{id}/update', [FAQ::class, 'admin_update'])->name('admin.faq.update');
    Route::get('/faq/{id}/delete', [FAQ::class, 'admin_delete'])->name('admin.faq.delete');
});


Route::get('/json', function() {
    $json = file_get_contents('https://gist.githubusercontent.com/Dhaneshmonds/1b0ca257b1c34e4842528dcb826ee880/raw/bf0632f3b2a613ac5cb80b9f1dfcf7ff16b7c373/IndianStatesDistricts.json');
    $data = json_decode($json);
    foreach($data as $obj) {
        foreach($obj as $state) {
            echo $state->name;
            echo " ".$state->code;
            echo count($state->districts);
            echo strtolower(str_replace(' ', '-', $state->type));
            echo "<br>";

            if(count($state->districts) > 0) {
                foreach($state->districts as $district) {
                    echo $district->name;
                    echo "<br>";
                }
            }

            echo "<hr>";
        }
    }
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
