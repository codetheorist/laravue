<?php

/**
 * This file is part of Restaurant
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
    | This is the Auth model used by Restaurant.
    |
    */
    'user_model' => config('auth.providers.users.model', App\User::class),

    /*
    |--------------------------------------------------------------------------
    | Restaurant users Table
    |--------------------------------------------------------------------------
    |
    | This is the users table name used by Restaurant.
    |
    */
    'users_table' => 'users',

    /*
    |--------------------------------------------------------------------------
    | Restaurant Model
    |--------------------------------------------------------------------------
    |
    | This is the Restaurant model used by Restaurant to create correct relations.  Update
    | the team if it is in a different namespace.
    |
    */
    'restaurant_model' => Restaurant::class,

    /*
    |--------------------------------------------------------------------------
    | Teamwork teams Table
    |--------------------------------------------------------------------------
    |
    | This is the teams table name used by Teamwork to save teams to the database.
    |
    */
    'restauranter_restaurants_table' => 'restaurants',

    /*
    |--------------------------------------------------------------------------
    | Teamwork team_user Table
    |--------------------------------------------------------------------------
    |
    | This is the team_user table used by Teamwork to save assigned teams to the
    | database.
    |
    */
    'restauranter_user_table' => 'restaurant_users',

    /*
    |--------------------------------------------------------------------------
    | User Foreign key on Teamwork's team_user Table (Pivot)
    |--------------------------------------------------------------------------
    */
    'user_foreign_key' => 'id',

    /*
    |--------------------------------------------------------------------------
    | Teamwork Team Invite Model
    |--------------------------------------------------------------------------
    |
    | This is the Team Invite model used by Teamwork to create correct relations.
    | Update the team if it is in a different namespace.
    |
    */
    'invite_model' => RestaurantInvite::class,

    /*
    |--------------------------------------------------------------------------
    | Teamwork team invites Table
    |--------------------------------------------------------------------------
    |
    | This is the team invites table name used by Teamwork to save sent/pending
    | invitation into teams to the database.
    |
    */
    'restauranter_invites_table' => 'restaurant_invites',
];
