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

/**
 * Teamwork routes
 */
Route::group(['prefix' => 'teams', 'namespace' => 'Teamwork'], function()
{
    Route::get('/', 'TeamController@index')->name('teams.index');
    Route::get('create', 'TeamController@create')->name('teams.create');
    Route::post('teams', 'TeamController@store')->name('teams.store');
    Route::get('edit/{id}', 'TeamController@edit')->name('teams.edit');
    Route::put('edit/{id}', 'TeamController@update')->name('teams.update');
    Route::delete('destroy/{id}', 'TeamController@destroy')->name('teams.destroy');
    Route::get('switch/{id}', 'TeamController@switchTeam')->name('teams.switch');

    Route::get('members/{id}', 'TeamMemberController@show')->name('teams.members.show');
    Route::get('members/resend/{invite_id}', 'TeamMemberController@resendInvite')->name('teams.members.resend_invite');
    Route::post('members/{id}', 'TeamMemberController@invite')->name('teams.members.invite');
    Route::delete('members/{id}/{user_id}', 'TeamMemberController@destroy')->name('teams.members.destroy');

    Route::get('accept/{token}', 'AuthController@acceptInvite')->name('teams.accept_invite');
});
/**
 * Teamwork routes
 */
Route::group(['prefix' => 'restaurants', 'namespace' => 'Restauranter'], function()
{
    Route::get('/', 'RestaurantController@index')->name('restaurants.index');
    Route::get('create', 'RestaurantController@create')->name('restaurants.create');
    Route::post('restaurants', 'RestaurantController@store')->name('restaurants.store');
    Route::get('edit/{id}', 'RestaurantController@edit')->name('restaurants.edit');
    Route::put('edit/{id}', 'RestaurantController@update')->name('restaurants.update');
    Route::delete('destroy/{id}', 'RestaurantController@destroy')->name('restaurants.destroy');
    Route::get('switch/{id}', 'RestaurantController@switchRestaurant')->name('restaurants.switch');

    Route::get('members/{id}', 'RestaurantStaffController@show')->name('restaurants.members.show');
    Route::get('members/resend/{invite_id}', 'RestaurantStaffController@resendInvite')->name('restaurants.members.resend_invite');
    Route::post('members/{id}', 'RestaurantStaffController@invite')->name('restaurants.members.invite');
    Route::delete('members/{id}/{user_id}', 'RestaurantStaffController@destroy')->name('restaurants.members.destroy');

    Route::get('accept/{token}', 'AuthController@acceptInvite')->name('restaurants.accept_invite');
});

Route::get('/', function () {
    return view('welcome');
})->name('welcome');
Route::get('/test', 'TestController@index');
Route::get('/logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/admin', 'ProfileController@show')->name('admin');
Route::get('/admin/restaurants', 'ProfileController@show')->name('profile');
Route::get('/admin/profile', 'ProfileController@show')->name('profile');
Route::get('/admin/permissions', 'ProfileController@show')->name('permissions');
Route::get('/admin/roles', 'ProfileController@show')->name('roles');
Route::get('/admin/user-list', 'ProfileController@show')->name('roles');
Route::any('{all}', function () {
    return view('layouts.app');
})->where(['all' => '.*']);

Auth::routes();
