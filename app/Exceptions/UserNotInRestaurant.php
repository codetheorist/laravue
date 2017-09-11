<?php

namespace App\Exceptions;

use RuntimeException;

class UserNotInRestaurantException extends RuntimeException
{

    /**
     * Name of the affected restaurant
     *
     * @var string
     */
    protected $restaurant;

    /**
     * Set the affected restaurant
     *
     * @param  string   $restaurant
     * @return $this
     */
    public function setRestaurant($restaurant)
    {
        $this->restaurant = $restaurant;

        $this->message = "The user is not in the restaurant {$restaurant}";

        return $this;
    }

    /**
     * Get the affected team.
     *
     * @return string
     */
    public function getRestaurant()
    {
        return $this->restaurant;
    }
}
