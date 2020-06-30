<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckRole;
use App\User;

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

Auth::routes([
    'register' => false, // Registration Routes...
    'verify' => false, // Email Verification Routes...
    'confirm' => false
]);

//locale
    Route::get('/set-language/{lang}', 'LanguagesController@set')->name('set.language');

//Dashboard
    Route::get('/', 'DashboardController@index', ['name' => 'Dashboard'])->name("Dashboard");

Route::group(['middleware' => 'is.not.admin'], function () {
//Profile
    Route::resource('/profile', 'ProfileController')->middleware('auth');

//Project
    Route::resource('/professor/project', 'ProfessorProjectsController')->middleware('auth');
    Route::resource('/student/project', 'StudentProjectsController')->middleware('auth');

//Post
    Route::get('/professor/project/{projectId}/post', 'PostController@show')->middleware('auth');
    Route::get('/student/project/{projectId}/post', 'PostController@show')->middleware('auth');
    Route::post('/post', 'PostController@store')->middleware('auth');
    Route::post('/post', 'PostController@reply')->middleware('auth');
    Route::delete('/professor/project/{projectId}/post', 'PostController@destroyComment')->middleware('auth');
    Route::delete('/student/project/{projectId}/post', 'PostController@destroyComment')->middleware('auth');
    Route::resource('/professor/project/{projectId}/post', 'PostController')->middleware('auth');
    Route::resource('/student/project/{projectId}/post', 'PostController')->middleware('auth');

//Chat
    Route::get('/chat', 'ChatController@index')->name('chat')->middleware('auth');
    Route::get('/message/{entity}/{id}', 'ChatController@getMessage')->name('message')->middleware('auth');
    Route::get('profile/message/{entity}/{id}', 'ChatController@getMessage')->name('message')->middleware('auth');
    Route::get('student/message/{entity}/{id}', 'ChatController@getMessage')->name('message')->middleware('auth');
    Route::post('/message', 'ChatController@sendMessage')->middleware('auth');
    Route::post('profile/message', 'ChatController@sendMessage')->middleware('auth');

    Route::post('student/project/message', 'ChatController@sendMessage')->middleware('auth');
    Route::post('student/project/{projectId}/post/message', 'ChatController@sendMessage')->middleware('auth');
    Route::post('student/project/{projectId}/message', 'ChatController@sendMessage')->middleware('auth');

    Route::post('professor/project/message', 'ChatController@sendMessage')->middleware('auth');
    Route::get('/searchchat','SearchController@index', ['name' => 'searchchat'])->name("searchchat")->middleware('auth');
    Route::get('/search','SearchController@search')->middleware('auth');
    Route::post('/pusher/auth', 'ChatController@authorizeUser')->middleware('auth');



//Groups
    Route::get('student/project/{id}/groups', 'GroupController@show')->middleware('auth');
    Route::post('student/project/{id}/groups','GroupController@store')->middleware('auth');
    Route::put('student/project/{id}/update/groups','GroupController@update')->middleware('auth');
    Route::delete('student/project/{id}/destroy/groups','GroupController@destroy')->middleware('auth');
});

//Admin
    Route::group(['middleware' => 'is.admin'], function () {
        Route::get('/admin/', 'AdminDashboardController@index');
        Route::get('/admin/{table}', 'AdminController@index');
        Route::post('/admin/{table}/store', 'AdminController@store');
        Route::get("/admin/edit-user/{id}", 'AdminController@edit');
        Route::put("/admin/edit-update/", 'AdminController@update');
        Route::delete('/admin/{table}/delete/', 'AdminController@destroy');
        Route::post('/admin/{table}/import/', 'AdminController@import');
    });
