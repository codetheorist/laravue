<?php

/**
 * This file is part of Restauranter
 *
 * @license MIT
 * @package Restaurant
 */

return [
    /*
    |--------------------------------------------------------------------------
    | Auth Model
    |--------------------------------------------------------------------------
    |
    | This is the Auth model used by Restauranter.
    |
    */
    'user_model' => config('auth.providers.users.model', App\User::class),

    /*
    |--------------------------------------------------------------------------
    | Restaurant users Table
    |--------------------------------------------------------------------------
    |
    | This is the users table name used by Restauranter.
    |
    */
    'users_table' => 'users',

    /*
    |--------------------------------------------------------------------------
    | Restaurant Model
    |--------------------------------------------------------------------------
    |
    | This is the Restaurant model used by Restauranter to create correct relations.  Update
    | the restaurant if it is in a different namespace.
    |
    */
    'restaurant_model' => App\Restaurant::class,

    /*
    |--------------------------------------------------------------------------
    | Restauranter Restaurants Table
    |--------------------------------------------------------------------------
    |
    | This is the restaurants table name used by Restauranter to save restaurants to the database.
    |
    */
    'restaurants_table' => 'restaurants',

    /*
    |--------------------------------------------------------------------------
    | Restaurant Model
    |--------------------------------------------------------------------------
    |
    | This is the Restaurant Team model used by Restauranter to create correct relations.  Update
    | the restaurant if it is in a different namespace.
    |
    */
    'restaurant_team_model' => App\RestaurantTeam::class,

    /*
    |--------------------------------------------------------------------------
    | Restauranter Restaurants Table
    |--------------------------------------------------------------------------
    |
    | This is the restaurant teams table name used by Restauranter to save restaurant teams to the database.
    |
    */
    'restaurant_teams_table' => 'restaurant_teams',

    /*
    |--------------------------------------------------------------------------
    | Restaurant Model
    |--------------------------------------------------------------------------
    |
    | This is the Restaurant Team model used by Restauranter to create correct relations.  Update
    | the restaurant if it is in a different namespace.
    |
    */
    'restaurant_team_permission_model' => App\RestaurantTeamPermission::class,

    /*
    |--------------------------------------------------------------------------
    | Restauranter Restaurants Table
    |--------------------------------------------------------------------------
    |
    | This is the restaurant teams table name used by Restauranter to save restaurant teams to the database.
    |
    */
    'restaurant_team_permissions_table' => 'restaurant_team_permissions',

    /*
    |--------------------------------------------------------------------------
    | Restauranter restaurant_staff Table
    |--------------------------------------------------------------------------
    |
    | This is the restaurant_user table used by Restauranter to save assigned restaurants to the
    | database.
    |
    */
    'restaurant_staff_table' => 'restaurant_staff',

    /*
    |--------------------------------------------------------------------------
    | User Foreign key on Restauranter's restaurant_user Table (Pivot)
    |--------------------------------------------------------------------------
    */
    'user_foreign_key' => 'id',

    /*
    |--------------------------------------------------------------------------
    | Restauranter Restaurant Invite Model
    |--------------------------------------------------------------------------
    |
    | This is the Restaurant Invite model used by Restauranter to create correct relations.
    | Update the restaurant if it is in a different namespace.
    |
    */
    'invite_model' => App\RestaurantInvite::class,

    /*
    |--------------------------------------------------------------------------
    | Restauranter restaurant invites Table
    |--------------------------------------------------------------------------
    |
    | This is the restaurant invites table name used by Restauranter to save sent/pending
    | invitation into restaurants to the database.
    |
    */
    'restaurant_invites_table' => 'restaurant_invites',
];
