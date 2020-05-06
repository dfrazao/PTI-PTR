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

Route::get('/set-language/{lang}', 'LanguagesController@set')->name('set.language');

Route::get('/', 'DashboardController@index', ['name' => 'Dashboard'])->name("Dashboard");

//Route::put('/profile/{id}', 'ProfileController@updateProfilePhoto')->middleware('auth');
Route::resource('/profile', 'ProfileController')->middleware('auth');

Route::resource('/professor/project', 'ProfessorProjectsController')->middleware('auth');
Route::resource('/student/project', 'StudentProjectsController')->middleware('auth');

Route::get('/student/project/{projectId}/post', 'PostController@show')->middleware('auth');
Route::post('/post', 'PostController@store')->middleware('auth');
Route::post('/post', 'PostController@reply')->middleware('auth');
Route::delete('/student/project/{projectId}/post', 'PostController@destroyComment')->middleware('auth');
Route::resource('/student/project/{projectId}/post', 'PostController')->middleware('auth');



Route::get('/chat', 'ChatController@index');



//Route::get('/profile', 'ProfileController@index', ['name' => 'Profile']);
//Route::get('/course', 'ProfileController@index', ['name' => 'Profile']);

//Route::get('/groups', 'ProfileController@index', ['name' => 'Profile']);

//Route::get('/profile', 'ProfileController@index', ['name' => 'Profile']);


// Student


Route::get('student/project/{id}/groups', 'GroupController@show');
Route::post('student/project/{id}','GroupController@store');

// Professor

// Admin
    Route::get('/admin/', 'AdminController@index');
    Route::get('/admin/{table}', 'AdminController@index');
    Route::post('/admin/{table}/store', 'AdminController@store');
    Route::get("/admin/edit-user/{id}",'AdminController@edit');
    Route::put("/admin/edit-update/",'AdminController@update');
    Route::delete('/admin/{table}/delete/','AdminController@destroy');
    Route::post('/admin/{table}/import/','AdminController@import');

