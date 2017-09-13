<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class Restaurant extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table;

    /**
     * @var array
     */
    protected $fillable = ['display_name', 'name', 'description', 'owner_id', 'enabled'];

    protected static $logAttributes = ['display_name', 'name', 'description', 'owner_id', 'enabled'];

    protected static $logOnlyDirty = true;
    /**
     * Get the message that needs to be logged for the given event name.
     *
     * @param string $eventName
     * @return string
     */
    public function getDescriptionForEvent($eventName)
    {
        if ($eventName == 'created')
        {
            return 'Restaurant #' . $this->id . ' was created';
        }

        if ($eventName == 'updated')
        {
            return 'Restaurant #' . $this->id . ' was updated';
        }

        if ($eventName == 'deleted')
        {
            return 'Restaurant #' . $this->id . ' was deleted';
        }

        return '';
    }

    /**
     * Creates a new instance of the model.
     *
     * @param array $attributes
     */
    public function __construct( array $attributes = [ ] )
    {
        parent::__construct( $attributes );
        $this->table = Config::get( 'restauranter.restaurants_table' );
    }

    /**
     * One-to-Many relation with the invite model
     * @return mixed
     */
    public function invites()
    {
        return $this->hasMany( Config::get('restauranter.invite_model'), 'restaurant_id', 'id');
    }

    /**
     * Many-to-Many relations with the user model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(Config::get('restauranter.user_model'), Config::get('restauranter.restaurant_staff_table'), 'restaurant_id','user_id')->withTimestamps();
    }

    /**
     * Has-One relation with the user model.
     * This indicates the owner of the team
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function owner()
    {
        $userModel   = Config::get( 'restauranter.user_model' );
        $userKeyName = ( new $userModel() )->getKeyName();
        return $this->hasOne(Config::get('restauranter.user_model'), $userKeyName, "owner_id");
    }

    /**
     * Helper function to determine if a user is part
     * of this team
     *
     * @param Model $user
     * @return bool
     */
    public function hasUser( Model $user )
    {
        return $this->users()->where( $user->getKeyName(), "=", $user->getKey() )->first() ? true : false;
    }

}
