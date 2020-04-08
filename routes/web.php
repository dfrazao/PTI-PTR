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

Route::resource('/profile', 'ProfileController');

Route::resource('/professor/project', 'ProfessorProjectsController');



//Route::get('/profile', 'ProfileController@index', ['name' => 'Profile']);
//Route::get('/course', 'ProfileController@index', ['name' => 'Profile']);

//Route::get('/groups', 'ProfileController@index', ['name' => 'Profile']);

//Route::get('/profile', 'ProfileController@index', ['name' => 'Profile']);


// Student


// Professor
