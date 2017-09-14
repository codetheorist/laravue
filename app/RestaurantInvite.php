<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use App\Traits\RestaurantInviteTrait;


class RestaurantInvite extends Model
{
    use RestaurantInviteTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table;

    /**
     * Creates a new instance of the model.
     *
     * @param array $attributes
     */
    public function __construct( array $attributes = [ ] )
    {
        parent::__construct( $attributes );
        $this->table = Config::get( 'restauranter.restaurant_invites_table' );
    }
}
