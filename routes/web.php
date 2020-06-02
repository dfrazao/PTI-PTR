<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckRole;


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

//Chat
    Route::get('/chat', 'ChatController@index')->name('chat');
    Route::get('/message/{id}', 'ChatController@getMessage')->name('message');
    Route::get('profile/message/{id}', 'ChatController@getMessage')->name('message');
    Route::get('student/message/{id}', 'ChatController@getMessage')->name('message');
    Route::post('/message', 'ChatController@sendMessage');
    Route::post('profile/message', 'ChatController@sendMessage');
    Route::post('student/project/message', 'ChatController@sendMessage');
    Route::post('student/project/{projectId}/post/message', 'ChatController@sendMessage');
    Route::post('student/project/{projectId}/message', 'ChatController@sendMessage');
    Route::post('professor/project/message', 'ChatController@sendMessage');
    Route::get('/searchchat','SearchController@index', ['name' => 'searchchat'])->name("searchchat");
    Route::get('/search','SearchController@search');
    Route::post('/pusher/auth', 'ChatController@authorizeUser');


// Student
    Route::get('student/project/{id}/groups', 'GroupController@show')->middleware('auth');
    Route::post('student/project/{id}/groups','GroupController@store')->middleware('auth');
    Route::put('student/project/{id}/update/groups','GroupController@update')->middleware('auth');
    Route::delete('student/project/{id}/destroy/groups','GroupController@destroy')->middleware('auth');
// Professor

// Admin
    Route::get('/admin/', 'AdminDashboardController@index', ['name' => 'Admin'])->name("Admin")->middleware(CheckRole::class);
    Route::get('/admin/{table}', 'AdminController@index', ['name' => 'Admin'])->name("Admin")->middleware(CheckRole::class);
    Route::post('/admin/{table}/store', 'AdminController@store')->middleware(CheckRole::class);
    Route::get("/admin/edit-user/{id}",'AdminController@edit')->middleware(CheckRole::class);
    Route::put("/admin/edit-update/",'AdminController@update')->middleware(CheckRole::class);
    Route::delete('/admin/{table}/delete/','AdminController@destroy')->middleware(CheckRole::class);
    Route::post('/admin/{table}/import/','AdminController@import')->middleware(CheckRole::class);

