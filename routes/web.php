<?php

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

Route::get('/', function () {
    return view('frontend.register');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');

// ==============Register===================
Route::get('/', 'Auth\RegisterController@getRegister')->name('auth.index');
Route::post('/register', 'Auth\RegisterController@postRegister')->name('auth.postRegister');
//===============End Register===============


// ==============Login===================
Route::get('/login', 'Auth\LoginController@getLogin')->name('auth.getLogin');
Route::post('/login', 'Auth\LoginController@postLogin')->name('auth.postLogin');
//===============End Login===============


// ==============Logout===================
Route::get('/logout','Auth\LogoutController@getLogOut')->name('auth.getLogOut');
//===============End Logout===============


//==============Dashboard===================
Route::get('/dashboard','Task\TaskController@getTask')->name('task.getTask');
Route::post('/dashboard/addTask','Task\TaskController@postAddTask')->name('task.postAddTask');
Route::put('/dashboard/editTask','Task\TaskController@editTask')->name('task.editTask');

//==============End Dashboard===============



