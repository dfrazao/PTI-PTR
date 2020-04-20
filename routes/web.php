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



Route::resource('/student/project', 'StudentProjectsController')->middleware('auth');

Route::get('/student/project/{projectId}/post', 'PostController@show')->middleware('auth');
Route::post('/post', 'PostController@store')->middleware('auth');
//Route::resource('/student/project/{projectId}/post', 'PostController')->middleware('auth');


Route::resource('createPost', 'PostController', ['only' => ['store', 'update', 'destroy', 'create', 'edit', 'search', 'cms']]);
Route::resource('showPost', 'PostController', ['only' => ['store']]);


/*Route::resource('blog', 'BlogController', ['only' => ['store', 'update', 'destroy', 'create', 'edit', 'search', 'cms']]);
Route::resource('review', 'ReviewController', ['only' => ['store', 'update', 'destroy','create', 'edit', 'search', 'cms']]);
Route::get('/home', 'HomeController@index');*/






//Route::get('/profile', 'ProfileController@index', ['name' => 'Profile']);
//Route::get('/course', 'ProfileController@index', ['name' => 'Profile']);

//Route::get('/groups', 'ProfileController@index', ['name' => 'Profile']);

//Route::get('/profile', 'ProfileController@index', ['name' => 'Profile']);


// Student


// Professor

// Admin
//Route::group(['middleware' => ['auth','admin']], function (){
    Route::get('/admin', 'AdminController@index', ['name' => 'tables']);
Route::resource('/admin/{table}', 'AdminController');

    Route::get("/admin/edit-user/{id}",'AdminController@edit');
    Route::put("/admin/edit-user-update/{id}",'AdminController@update');
    Route::delete('/admin/delete-user/{id}','AdminController@destroy');
    Route::post('/admin/import/','AdminController@import');
//});
