<?php

use Illuminate\Http\Request;

Route::post('sessions/create', 'AuthenticateController@authenticate')->name('api.sessions.create');
Route::post('token', 'AuthenticateController@token')->name('api.authenticate.token');

// Authentication route
// Route::post('authenticate', 'JwtAuthenticateController@authenticate')->name('api.jwt.authenticate');
// Route::post('register', 'Auth\RegisterController@create')->name('api.users.register');

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['middleware' => 'jwt.auth'], function()
{
    Route::get('/permissions', 'PermissionController@index')->name('api.permissions.index');
    Route::get('/roles', 'PermissionController@index')->name('api.roles.index');
    Route::get('user', 'UserController@show')->name('api.users.show');
    Route::post('user', 'UserController@update')->name('api.auth.update');
    Route::get('users', 'UserController@index')->name('api.users.index');
    Route::post('addresses/new', 'AddressController@store')->name('api.addresses.new');
    Route::delete('addresses/{id}', 'AddressController@destroy')->name('api.addresses.delete');
});
