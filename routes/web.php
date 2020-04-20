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

Auth::routes();

Route::get('/', 'DashboardController@index', ['name' => 'Dashboard'])->name("Dashboard");

//Route::put('/profile/{id}', 'ProfileController@updateProfilePhoto')->middleware('auth');
Route::resource('/profile', 'ProfileController')->middleware('auth');

Route::resource('/professor/project', 'ProfessorProjectsController')->middleware('auth');

Route::put("/student/project",'StudentProjectsController@update');
Route::resource('/student/project', 'StudentProjectsController')->middleware('auth');

Route::get('/student/project/{projectId}/post', 'PostController@show')->middleware('auth');
Route::post('/post', 'PostController@store')->middleware('auth');
Route::resource('/student/project/{projectId}/post', 'PostController')->middleware('auth');








//Route::get('/profile', 'ProfileController@index', ['name' => 'Profile']);
//Route::get('/course', 'ProfileController@index', ['name' => 'Profile']);

//Route::get('/groups', 'ProfileController@index', ['name' => 'Profile']);

//Route::get('/profile', 'ProfileController@index', ['name' => 'Profile']);


// Student


// Professor

// Admin
//Route::group(['middleware' => ['auth','admin']], function (){
    Route::get('/admin/{table}', 'AdminController@index', ['name' => 'tables']);
    Route::post('/admin/{table}/store', 'AdminController@store');
    Route::get("/admin/edit-user/{id}",'AdminController@edit');
    Route::put("/admin/edit-update/",'AdminController@update');
    Route::delete('/admin/{table}/delete/','AdminController@destroy');
    //Route::delete('/admin/{table}/delete/','AdminController@destroySE');
    Route::post('/admin/{table}/import/','AdminController@import');
//});
