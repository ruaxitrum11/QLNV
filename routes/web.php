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
Route::put('/dashboard/editTask/{id}','Task\TaskController@editTask')->name('task.editTask');
Route::delete('/dashboard/deleteTask/{id}','Task\TaskController@deleteTask')->name('task.deleteTask');
//==============End Dashboard===============

//==============Admin Home===================
Route::group(['middleware'=>'permission'],function(){
    Route::get('/admin','Admin\HomeController@getHome')->name('admin.getHome');
    Route::post('/admin/addUser','Admin\HomeController@addUser')->name('admin.addUser');
    Route::get('/admin/userInfo/{id}','Admin\HomeController@infoUser')->name('admin.infoUser');
    Route::put('/admin/updateUser/{id}','Admin\HomeController@updateUser')->name('admin.updateUser');
    Route::delete('/admin/deleteUser/{id}','Admin\HomeController@deleteUser')->name('admin.deleteUser');
});
//Route::get('/admin','Admin\HomeController@getHome')->name('admin.getHome');
//==============End Admin Home===============


