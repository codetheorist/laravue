<?php

namespace App\Events;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Queue\SerializesModels;

class UserInvitedToRestaurant
{
    use SerializesModels;

    /**
     * @type Model
     */
    protected $invite;

    public function __construct($invite)
    {
        $this->invite = $invite;
    }

    /**
     * @return Model
     */
    public function getInvite()
    {
        return $this->invite;
    }

    /**
     * @return int
     */
    public function getRestaurantId()
    {
        return $this->invite->restaurant_id;
    }
}
