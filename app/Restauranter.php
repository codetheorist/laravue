<?php

namespace App;

use Illuminate\Support\Facades\Config;
use App\Events\UserInvitedToRestaurant;

/**
 * This file is part of Teamwork
 *
 * @license MIT
 * @package Teamwork
 */

class Restauranter
{
    /**
     * Laravel application
     *
     * @var \Illuminate\Foundation\Application
     */
    public $app;

    /**
     * Create a new Teamwork instance.
     *
     * @param \Illuminate\Foundation\Application $app
     */
    public function __construct( $app )
    {
        $this->app = $app;
    }

    /**
     * Get the currently authenticated user or null.
     */
    public function user()
    {
        return $this->app->auth->user();
    }

    /**
     * Invite an email adress to a restaurant.
     * Either provide a email address or an object with an email property.
     *
     * If no restaurant is given, the current_restaurant_id will be used instead.
     *
     * @param string|User $user
     * @param null|Team $restaurant
     * @param callable $success
     * @throws \Exception
     */
    public function inviteToRestaurant( $user, $restaurant = null, callable $success = null )
    {
        if ( is_null( $restaurant ) )
        {
            $restaurant = $this->user()->current_restaurant_id;
        } elseif( is_object( $restaurant ) )
        {
            $restaurant = $restaurant->getKey();
        }elseif( is_array( $restaurant ) )
        {
            $restaurant = $restaurant["id"];
        }

        if( is_object( $user ) && isset($user->email) )
        {
            $email = $user->email;
        } elseif( is_string($user) ) {
            $email = $user;
        } else {
            throw new \Exception('The provided object has no "email" attribute and is not a string.');
        }

        $invite               = $this->app->make(Config::get('restauranter.invite_model'));
        $invite->user_id      = $this->user()->getKey();
        $invite->restaurant_id      = $restaurant;
        $invite->type         = 'invite';
        $invite->email        = $email;
        $invite->accept_token = md5( uniqid( microtime() ) );
        $invite->deny_token   = md5( uniqid( microtime() ) );
        $invite->save();

        if ( !is_null( $success ) )
        {
            event(new UserInvitedToRestaurant($invite));
            return $success( $invite );
        }
    }

    /**
     * Checks if the given email address has a pending invite for the
     * provided Team
     * @param $email
     * @param Team|array|integer $restaurant
     * @return bool
     */
    public function hasPendingInvite( $email, $restaurant )
    {
        if( is_object( $restaurant ) )
        {
            $restaurant = $restaurant->getKey();
        }
        if( is_array( $restaurant ) )
        {
            $restaurant = $restaurant["id"];
        }
        return $this->app->make(Config::get('restauranter.invite_model'))->where('email', "=", $email)->where('restaurant_id', "=", $restaurant )->first() ? true : false;
    }

    /**
     * @param $token
     * @return mixed
     */
    public function getInviteFromAcceptToken( $token )
    {
        return $this->app->make(Config::get('restauranter.invite_model'))->where('accept_token', '=', $token)->first();
    }

    /**
     * @param TeamInvite $invite
     */
    public function acceptInvite( RestaurantInvite $invite )
    {
        $this->user()->attachRestaurant( $invite->restaurant );
        $invite->delete();
    }

    /**
     * @param $token
     * @return mixed
     */
    public function getInviteFromDenyToken( $token )
    {
        return $this->app->make(Config::get('restauranter.invite_model'))->where('deny_token', '=', $token)->first();
    }

    /**
     * @param TeamInvite $invite
     */
    public function denyInvite( RestaurantInvite $invite )
    {
        $invite->delete();
    }
}
