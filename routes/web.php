<?php

use App\Models\User;
use App\Models\Mission;

use App\Mail\Volunteers\Welcome;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MailController;
use App\Http\Controllers\Dashboard\Admin\FAQ;
use App\Http\Controllers\Dashboard\Volunteers;
use App\Http\Controllers\Dashboard\OcrController;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Api\SearchFilterController;
use App\Http\Controllers\Dashboard\SearchController;
use App\Http\Controllers\Dashboard\Admin\MissionAdmin;
use App\Http\Controllers\Dashboard\DarkmodeController;
use App\Http\Controllers\Dashboard\MissionsController;
use App\Http\Controllers\Dashboard\UserEditController;
use App\Http\Controllers\Dashboard\Admin\UserController;
use App\Http\Controllers\Dashboard\Admin\AccessController;
use App\Http\Controllers\Dashboard\Admin\SettingController;
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
Route::post('/upload-image',[OcrController::class,'parse_text'])->name('parse.text');

Route::get('/sendmail', function() {
    $missions = Mission::where('status', '!=', Mission::COMPLETED)->groupBy('volunteer_id')->get();
        foreach($missions as $mission) {
            echo $mission->volunteer_id;
            echo "<br>";
        }
});
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/r/{referral?}', [HomeController::class, 'referral'])->name('generate.referrallink');
Route::get('/view/{id?}', [HomeController::class, 'view'])->name('home.view');
Route::get('/report/{id?}', [HomeController::class, 'report'])->name('home.report');
Route::post('/submit-report/{id?}', [HomeController::class, 'store_report'])->name('home.submit.report');
Route::get('/view-profile', [UserEditController::class, 'show'])->name('home.profile.view');
Route::get('/edit-profile', [UserEditController::class, 'edit'])->name('home.profile.edit');
Route::put('/user', [UserEditController::class, 'update'])->name('home.profile.save');


Route::get('/crowdsourced', [HomeController::class, 'crowdsourced_show'])->name('home.crowdsourced.index');

Route::prefix('crowdsourced')->group(function () {
    Route::get('/', [HomeController::class, 'crowdsourced_index'])->name('home.crowdsourced.index');
    Route::get('/websites', [HomeController::class, 'crowdsourced_websites'])->name('home.crowdsourced.websites');
    Route::get('/instagram', [HomeController::class, 'crowdsourced_instagram'])->name('home.crowdsourced.instagram');
    Route::get('/telegram', [HomeController::class, 'crowdsourced_telegram'])->name('home.crowdsourced.telegram');
    Route::get('/discord', [HomeController::class, 'crowdsourced_discord'])->name('home.crowdsourced.discord');
    Route::get('/helplines', [HomeController::class, 'crowdsourced_helplines'])->name('home.crowdsourced.helplines');

});


Route::get('/toggle-mode',[DarkmodeController::class,'toggle'])->name('home.toggle.mode');

Route::post('/post-comment/{id?}',[HomeController::class, 'add_comment'])->name('resource.postcomment');

Route::get('/search', [SearchController::class, 'search'])->name('home.search');

// to simply view the tweet using the search bar
Route::get('/tweets/{id}/view', [SearchController::class, 'view'])
    ->name('home.search.view');

Route::get('/search/results/{query?}', [SearchController::class, 'results'])
    ->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class])
    ->name('home.search.results');

// Route::get('/search/{query?}',[SearchFilterController::class, 'search_filter'])->name('search.filter');
// Route::get('/search/twitter/{query?}',[SearchFilterController::class, 'twitterSearch']);

Route::get('/add-resource', [HomeController::class, 'add_resource'])->name('home.add.resource');
Route::post('/add-resource/save', [HomeController::class, 'save_resource'])->name('home.save.resource');
Route::post('/add-resource/upload-image',[OcrController::class, 'generateText_getImage'])->name('home.resource.ocr');

Route::get('/chat-with-us')->name('home.chat_with_us');
Route::get('/view-app-status')->name('home.app_status');
Route::get('/terms',[HomeController::class,'terms'])->name('home.terms');

Route::get('/about', [HomeController::class, 'about'])->name('home.about');
Route::get('/how-to', [HomeController::class, 'how_to'])->name('home.howTo');
Route::get('/statistics', [HomeController::class, 'statistics'])->name('home.statistics');


Route::get('/privacy', [HomeController::class, 'privacy'])->name('home.privacy');

Route::get('/location', function() {
    Cache::put('location', 'TN', now()->addHours(1));
});

Route::get('/location/get', function() {
    dd(Cache::get('location'));
});


Route::middleware(['auth'])->group(function () {
    //All users using the routes below these, SHOULD
    //have logged in.

    Route::group(['middleware' => ['role:superadmin|moderator|volunteer']], function () {
        Route::prefix('volunteer')->group(function () {
            Route::get('/', [Volunteers::class, 'index'])->name('home.volunteers.index');
            Route::get('/test', [Volunteers::class, 'test']);
            Route::get('/missions', [Volunteers::class, 'getAllMissions']);
        });

        Route::prefix('mission')->group(function () {
            Route::get('/', [MissionsController::class, 'index'])->name('home.mission.index');
            Route::get('/leaderboard', [MissionsController::class, 'leaderboard'])->name('home.mission.leaderboard');
            //Using UUID because users should not "guess" the next mission IDs,
            //But still, other users should be able to validate someone else's missions.
            Route::get('/view/{uuid}', [MissionsController::class, 'view'])->name('home.mission.view');
            Route::get('/manage/{uuid}', [MissionAdmin::class, 'manage'])->name('admin.mission.manage');
			Route::post('/update/{id}', [MissionAdmin::class, 'update'])->name('admin.mission.update');
        });
    });


    Route::prefix('ocr')->group(function () {
        Route::get('/',[OcrController::class, 'index'])->name('ocr.index');
        Route::post('/upload-image',[OcrController::class,'getImage'])->name('ocr.parse.text');
    });

    Route::prefix('admin')->group(function () {

        Route::group(['middleware' => ['role:superadmin|moderator']], function () {

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

            Route::prefix('mission')->group(function () {
                Route::get('/', [MissionAdmin::class, 'index'])->name('admin.mission.index');
                Route::get('/dissolve/{id}', [MissionAdmin::class, 'dissolve'])->name('admin.mission.dissolve');
                Route::get('/assign/new', [MissionAdmin::class, 'assign'])->name('admin.mission.assign');
                Route::post('/assign/create', [MissionAdmin::class, 'create'])->name('admin.mission.create');
            });

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
        });

        Route::group(['middleware' => ['role:superadmin']], function () {
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


            Route::get('/activity',[HomeController::class,'activity'])->name('activity.log');
        });

        Route::group(['middleware' => ['role:superadmin|moderator']], function () {

          Route::get('/tweets', [TwitterController::class, 'index'])->name('admin.twitter.index');
          Route::get('/tweets/{id}/manage', [TwitterController::class, 'manage'])->name('admin.twitter.manage');
          Route::post('/tweets/{id}/update', [TwitterController::class, 'update'])->name('admin.twitter.update');
          Route::get('/tweet/{id}/convert', [TwitterController::class, 'convert'])->name('admin.twitter.convert');
          Route::post('/tweet/{id}/convert/save', [TwitterController::class, 'convert_save'])->name('admin.twitter.convert.save');
          Route::get('/tweets/{id}/delete', [TwitterController::class, 'delete'])->name('admin.twitter.delete');
        });

        Route::get('/tweets', [TwitterController::class, 'index'])->name('admin.twitter.index');
        Route::get('/tweets/{id}/manage', [TwitterController::class, 'manage'])->name('admin.twitter.manage');
        Route::post('/tweets/{id}/update', [TwitterController::class, 'update'])->name('admin.twitter.update');
        Route::get('/tweet/{id}/convert', [TwitterController::class, 'convert'])->name('admin.twitter.convert');
        Route::post('/tweet/{id}/convert/save', [TwitterController::class, 'convert_save'])->name('admin.twitter.convert.save');
        Route::get('/tweets/{id}/delete', [TwitterController::class, 'delete'])->name('admin.twitter.delete');


        Route::get('/activity',[HomeController::class,'activity'])->name('activity.log');
    });

    Route::group(['middleware' => ['role:superadmin']], function () {
        Route::prefix('setting')->group(function () {
            Route::get('/',[SettingController::class,'admin_setting_index'])->name('admin.setting.index');
            Route::get('/add-setting',[SettingController::class,'admin_setting_create'])->name('admin.setting.add');
            Route::post('/store-setting',[SettingController::class,'admin_setting_store'])->name('admin.setting.store');
            Route::get('{id}/edit-setting',[SettingController::class,'admin_setting_edit'])->name('admin.setting.edit');
            Route::post('{id}/update-setting',[SettingController::class,'admin_setting_update'])->name('admin.setting.update');
            Route::get('{id}/delete-setting',[SettingController::class,'admin_setting_delete'])->name('admin.setting.delete');
        });
    });


});


require __DIR__.'/auth.php';
