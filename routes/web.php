<?php

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

Route::view('/', 'dashboard.home.home');
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
