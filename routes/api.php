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
    Route::get('/stats', 'StatisticsController@index')->name('api.stats.index');
    Route::get('/permissions', 'PermissionController@index')->name('api.permissions.index');
    Route::get('/permissions', 'PermissionController@index')->name('api.permissions.index');
    Route::get('/roles', 'PermissionController@index')->name('api.roles.index');
    Route::get('user', 'UserController@show')->name('api.users.show');
    Route::post('user', 'UserController@update')->name('api.auth.update');
    Route::get('users', 'UserController@index')->name('api.users.index');
    Route::post('users/toggle/{id}', 'UserController@toggle')->name('api.users.toggle');
    Route::post('addresses/new', 'AddressController@store')->name('api.addresses.new');
    Route::delete('addresses/{id}', 'AddressController@destroy')->name('api.addresses.delete');
    /**
     * Teamwork routes
     */
    Route::group(['prefix' => 'restaurants', 'namespace' => 'Api'], function()
    {
        Route::get('/', 'RestaurantApiController@index')->name('api.restaurants.index');
        Route::get('create', 'RestaurantApiController@create')->name('api.restaurants.create');
        Route::post('restaurants', 'RestaurantApiController@store')->name('api.restaurants.store');
        Route::get('show/{id}', 'RestaurantApiController@show')->name('api.restaurants.show');
        Route::get('edit/{id}', 'RestaurantApiController@edit')->name('api.restaurants.edit');
        Route::post('edit/{id}', 'RestaurantApiController@update')->name('api.restaurants.update');
        Route::post('toggle/{id}', 'RestaurantApiController@toggle')->name('api.restaurants.toggle');
        Route::delete('destroy/{id}', 'RestaurantApiController@destroy')->name('api.restaurants.destroy');
        Route::get('switch/{id}', 'RestaurantApiController@switchRestaurant')->name('api.restaurants.switch');

        // Route::get('members/{id}', 'RestaurantStaffController@show')->name('restaurants.members.show');
        // Route::get('members/resend/{invite_id}', 'RestaurantStaffController@resendInvite')->name('restaurants.members.resend_invite');
        // Route::post('members/{id}', 'RestaurantStaffController@invite')->name('restaurants.members.invite');
        // Route::delete('members/{id}/{user_id}', 'RestaurantStaffController@destroy')->name('restaurants.members.destroy');

        // Route::get('accept/{token}', 'AuthController@acceptInvite')->name('restaurants.accept_invite');
    });
});

// Route::group(['namespace' => 'Api', 'middleware' => 'jwt.auth'], function() {
//     Route::get('/restaurants', 'RestaurantApiController@index')->name('api.restaurants.index');
// });
