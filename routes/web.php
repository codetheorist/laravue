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

// Route::any('{all}', function () {
//     return view('welcome');
// })->where(['all' => '.*']);

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/admin', 'ProfileController@show')->name('admin');
Route::get('/admin/profile', 'ProfileController@show')->name('profile');
Route::get('/admin/permissions', 'ProfileController@show')->name('permissions');
Route::get('/admin/roles', 'ProfileController@show')->name('roles');

Auth::routes();

