<?php

use Illuminate\Http\Request;

Route::post('sessions/create', 'AuthenticateController@authenticate');
Route::post('token', 'AuthenticateController@token');
// Authentication route
Route::post('authenticate', 'JwtAuthenticateController@authenticate');
Route::post('register', 'Auth\RegisterController@create');

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
    Route::get('/permissions', 'PermissionController@index');
    Route::get('user', 'UserController@show');
    Route::post('user', 'UserController@update');
    Route::get('users', 'UserController@index');
    Route::post('addresses/new', 'AddressController@store');
    Route::delete('addresses/{id}', 'AddressController@destroy');
});
