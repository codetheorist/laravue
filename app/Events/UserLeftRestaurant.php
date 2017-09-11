<?php

namespace App\Events;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Queue\SerializesModels;

class UserLeftRestaurant
{
    use SerializesModels;

    /**
     * @type Model
     */
    protected $user;

    /**
     * @type int
     */
    protected $restaurant_id;

    public function __construct($user, $restaurant_id)
    {
        $this->user = $user;
        $this->restaurant_id = $restaurant_id;
    }

    /**
     * @return Model
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @return int
     */
    public function getRestaurantId()
    {
        return $this->restaurant_id;
    }
}
