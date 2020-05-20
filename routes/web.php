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

Auth::routes([
    'register' => false, // Registration Routes...
    'verify' => false, // Email Verification Routes...
    'confirm' => false
]);

//locale
    Route::get('/set-language/{lang}', 'LanguagesController@set')->name('set.language');

//dashboard
    Route::get('/', 'DashboardController@index', ['name' => 'Dashboard'])->name("Dashboard");

//profile
    //Route::put('/profile/{id}', 'ProfileController@updateProfilePhoto')->middleware('auth');
    Route::resource('/profile', 'ProfileController')->middleware('auth');

//project
    Route::resource('/professor/project', 'ProfessorProjectsController')->middleware('auth');
    Route::resource('/student/project', 'StudentProjectsController')->middleware('auth');


//post
    Route::get('/professor/project/{projectId}/post', 'PostController@show')->middleware('auth');
    Route::get('/student/project/{projectId}/post', 'PostController@show')->middleware('auth');
    Route::post('/post', 'PostController@store')->middleware('auth');
    Route::post('/post', 'PostController@reply')->middleware('auth');
    Route::delete('/professor/project/{projectId}/post', 'PostController@destroyComment')->middleware('auth');
    Route::delete('/student/project/{projectId}/post', 'PostController@destroyComment')->middleware('auth');
    Route::resource('/professor/project/{projectId}/post', 'PostController')->middleware('auth');
    Route::resource('/student/project/{projectId}/post', 'PostController')->middleware('auth');


Route::get('/chat', 'ChatController@index')->name('chat');
Route::get('/message/{id}', 'ChatController@getMessage')->name('message');
Route::post('/message', 'ChatController@sendMessage');
Route::get('/searchchat','SearchController@index', ['name' => 'searchchat'])->name("searchchat");
Route::get('/search','SearchController@search');


// Student
    Route::get('student/project/{id}/groups', 'GroupController@show')->middleware('auth');
    Route::post('student/project/{id}','GroupController@store')->middleware('auth');
    Route::put('student/project/{id}/update','GroupController@update')->middleware('auth');

// Professor

// Admin
    Route::get('/admin/', 'AdminController@index');
    Route::get('/admin/{table}', 'AdminController@index');
    Route::post('/admin/{table}/store', 'AdminController@store');
    Route::get("/admin/edit-user/{id}",'AdminController@edit');
    Route::put("/admin/edit-update/",'AdminController@update');
    Route::delete('/admin/{table}/delete/','AdminController@destroy');
    Route::post('/admin/{table}/import/','AdminController@import');

