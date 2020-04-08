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

Route::get('/', 'Dashboard@index', ['name' => 'Dashboard']);

Route::get('/profile', 'Profile@index', ['name' => 'Profile']);

Route::resource('/professor/project', 'ProfessorProjectsController');



//Route::get('/profile', 'ProfileController@index', ['name' => 'Profile']);

//Route::get('/profile', 'ProfileController@index', ['name' => 'Profile']);

//Route::get('/profile', 'ProfileController@index', ['name' => 'Profile']);


// Student


// Professor
