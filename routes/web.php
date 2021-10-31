<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\PaymentController;
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


Route::prefix('admin')->group(function (){

    Route::middleware(['admin:admin', 'PreventBrowserBackHistory'])->group(function (){
        Route::get('', [
            'as' => 'admin.dashboard',
            'uses' => 'AdminController@dashboard'
        ]);

        Route::get('/list-users', [
            'as' => 'admin.list-users',
            'uses' => 'AdminController@listUsers'
        ]);

        Route::get('/results', [
            'as' => 'admin.results',
            'uses' => 'AdminController@results'
        ]);

        Route::get('/settings-page-vote', [
            'as' => 'admin.settings-page-vote',
            'uses' => 'AdminController@settingsPageVote'
        ]);

        Route::get('/get-all-users', [
            'as' => 'admin.get-all-users',
            'uses' => 'AdminController@getAllUsers'
        ]);

        Route::get('/get-all-candidates', [
            'as' => 'admin.get-all-candidates',
            'uses' => 'AdminController@getAllCandidates'
        ]);

        Route::get('/get-all-votes', [
            'as' => 'admin.get-all-votes',
            'uses' => 'AdminController@getAllVotes'
        ]);

        Route::get('/show-result', [
            'as' => 'admin.show-result',
            'uses' => 'AdminController@showResult'
        ]);


        //Function
        Route::post('/reset-candidates', [
            'as' => 'admin.reset-candidates',
            'uses' => 'AdminController@resetCandidates'
        ]);

        Route::post('/set-status-all-users', [
            'as' => 'admin.set-status-all-users',
            'uses' => 'AdminController@setStatusAllUsers'
        ]);

        Route::post('/set-status-user', [
            'as' => 'admin.set-status-user',
            'uses' => 'AdminController@setStatusUser'
        ]);

        Route::post('/set-status-page-vote', [
            'as' => 'admin.set-status-page-vote',
            'uses' => 'AdminController@setStatusPageVote'
        ]);

        Route::post('/set-qty', [
            'as' => 'admin.set-qty',
            'uses' => 'AdminController@setQty'
        ]);

        Route::post('/add-candidate', [
            'as' => 'admin.add-candidate',
            'uses' => 'AdminController@addCandidate'
        ]);

        Route::post('/remove-candidate', [
            'as' => 'admin.remove-candidate',
            'uses' => 'AdminController@removeCandidate'
        ]);

        Route::post('/import-user-create', [
            'as' => 'admin.import-user-create',
            'uses' => 'AdminController@importUserCreate'
        ]);

        Route::post('/logout', [
            'as' => 'admin.logout',
            'uses' => 'AdminController@logout'
        ]);

    });

    Route::middleware(['guest:admin', 'PreventBrowserBackHistory'])->group(function (){


        Route::get('/login', [
            'as' => 'admin.login',
            'uses' => 'AdminController@login'
        ]);

        Route::post('/check', [
            'as' => 'admin.check',
            'uses' => 'AdminController@check'
        ]);

    });

});



Route::name('main.')->group(function (){
    Route::get('/', function () {
        return view('main.index');
    });

    Route::get('/', [
        'as' => 'index',
        'uses' => 'HomeController@index'
    ]);

    Route::get('/club/ikbo', [
        'as' => 'club-ikbo',
        'uses' => 'HomeController@clubIKBO'
    ]);

    Route::get('/club/mirea-fc', [
        'as' => 'club-mirea-fc',
        'uses' => 'HomeController@clubMireaFC'
    ]);
});

////Test real-time
//Route::get('test', function () {
//    event(new App\Events\StatusLiked('Someone'));
//    return "Event has been sent!";
//});
//
//Route::get('/welcome', function () {
//    return view('welcome');
//});


Auth::routes();

Route::prefix('user')->name('user.')->group(function (){
    Route::middleware(['guest:web', 'PreventBrowserBackHistory'])->group(function (){

        //UI

        Route::get('/login', [
            'as' => 'login',
            'uses' => 'User\UserController@login'
        ]);

        Route::get('/password-recovery', [
            'as' => 'password-recovery',
            'uses' => 'User\UserController@passwordRecovery'
        ]);

        Route::post('/check', [
            'as' => 'check',
            'uses' => 'User\UserController@check'
        ]);

    });

    Route::middleware(['auth:web', 'PreventBrowserBackHistory'])->group(function (){
        //UI
        Route::get('/page-vote', [
            'as' => 'page-vote',
            'uses' => 'User\UserController@pageVote'
        ]);

        Route::get('/friends', [
            'as' => 'friends',
            'uses' => 'User\UserController@friends'
        ]);

        Route::get('/user-settings', [
            'as' => 'user-settings',
            'uses' => 'User\UserController@userSettings'
        ]);


        //Function
        Route::post('/create-vote', [
            'as' => 'create-vote',
            'uses' => 'User\UserController@createVote'
        ]);

        Route::post('/logout', [
            'as' => 'logout',
            'uses' => 'User\UserController@logout'
        ]);
        Route::post('/update-avatar', [
            'as' => 'updateAvatar',
            'uses' => 'User\UserController@updateAvatar'
        ]);
        Route::post('/update', [
            'as' => 'update',
            'uses' => 'User\UserController@update'
        ]);
        Route::post('/change-password', [
            'as' => 'changePassword',
            'uses' => 'User\UserController@changePassword'
        ]);

    });
});

