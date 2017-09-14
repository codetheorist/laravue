<?php

namespace App\Contracts;

/**
 * This file is part of Teamwork
 *
 * @license MIT
 * @package Teamwork
 */
interface RestauranterUserInterface
{
    /**
     * Many-to-Many relations with the user model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function restaurants();

    /**
     * has-one relation with the current selected restaurant model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function currentRestaurant();

    /**
     * One-to-Many relation with the invite model
     * @return mixed
     */
    public function invites();


    /**
     * Returns if the user owns a restaurant
     *
     * @return bool
     */
    public function isOwner();


    /**
     * Returns if the user owns the given restaurant
     *
     * @param mixed $restaurant
     * @return bool
     */
    public function isOwnerOfRestaurant( $restaurant );

    /**
     * Alias to eloquent many-to-many relation's attach() method.
     *
     * @param mixed $restaurant
     * @param array $pivotData
     */
    public function attachRestaurant( $restaurant, $pivotData = [] );

    /**
     * Alias to eloquent many-to-many relation's detach() method.
     *
     * @param mixed $restaurant
     */
    public function detachRestaurant( $restaurant );

    /**
     * Attach multiple restaurants to a user
     *
     * @param mixed $restaurants
     */
    public function attachRestaurants( $restaurants );

    /**
     * Detach multiple restaurants from a user
     *
     * @param mixed $restaurants
     */
    public function detachRestaurants( $restaurants );

    /**
     * Switch the current restaurant of the user
     *
     * @param object|array|integer $restaurant
     * @throws ModelNotFoundException
     * @throws UserNotInTeamException
     */
    public function switchRestaurant( $restaurant );
}
