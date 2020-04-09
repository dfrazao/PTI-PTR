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

Route::get('/', 'DashboardController@index', ['name' => 'Dashboard']);

Route::resource('/profile', 'ProfileController')->middleware('auth');

Route::resource('/professor/project', 'ProfessorProjectsController')->middleware('auth');

Route::resource('/student/project', 'StudentProjectsController')->middleware('auth');



//Route::get('/profile', 'ProfileController@index', ['name' => 'Profile']);
//Route::get('/course', 'ProfileController@index', ['name' => 'Profile']);

//Route::get('/groups', 'ProfileController@index', ['name' => 'Profile']);

//Route::get('/profile', 'ProfileController@index', ['name' => 'Profile']);


// Student


// Professor

// Admin
Route::group(['middleware' => ['auth','admin']], function (){
    Route::get('/admin', 'AdminController@index', ['name' => 'tables']);
    Route::get("/edit-user/{id}",'AdminController@edit');
    Route::put("/edit-user-update/{id}",'AdminController@update');
    Route::resource('/admin', 'AdminController');
});
