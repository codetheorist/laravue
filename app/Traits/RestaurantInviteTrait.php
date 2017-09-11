<?php

namespace App\Traits;

/**
 * This file is part of Teamwork
 *
 * @license MIT
 * @package Teamwork
 */

use Illuminate\Support\Facades\Config;

trait RestaurantInviteTrait
{
    /**
     * Has-One relations with the team model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function restaurant()
    {
        return $this->hasOne( Config::get( 'restauranter.restaurant_model' ), 'id', 'restaurant_id' );
    }

    /**
     * Has-One relations with the user model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function user()
    {
        return $this->hasOne( Config::get( 'restauranter.user_model' ), 'email', 'email' );
    }

    /**
     * Has-One relations with the user model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function inviter()
    {
        return $this->hasOne( Config::get( 'restauranter.user_model' ), 'id', 'user_id' );
    }

}
