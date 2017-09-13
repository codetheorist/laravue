<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use Spatie\Activitylog\Traits\LogsActivity;
use Tylercd100\LERN\Models\ExceptionModel;
use Mpociot\Teamwork\Traits\UserHasTeams;
use App\Traits\UserHasRestaurants;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Config;
use App\Events\UserJoinedRestaurant;
use App\Events\UserLeftRestaurant;
use App\Exceptions\UserNotInRestaurantException;

class User extends Authenticatable implements AuditableContract
{
    use UserHasRestaurants, UserHasTeams, EntrustUserTrait, Notifiable, Auditable, LogsActivity;

    public function getLogNameToUse(string $eventName = ''): string
    {
       return 'users';
    }

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
            return 'User #' . $this->id . ' was created';
        }

        if ($eventName == 'updated')
        {
            return 'User #' . $this->id . ' was updated';
        }

        if ($eventName == 'deleted')
        {
            return 'User #' . $this->id . ' was deleted';
        }

        return '';
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'username', 'email', 'password', 'occupation', 'created_at', 'updated_at'
    ];

    protected static $logAttributes = ['first_name', 'last_name', 'username', 'email', 'password', 'occupation', 'created_at', 'updated_at'];

    protected static $logOnlyDirty = true;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function addresses()
    {
        return $this->hasMany(Address::class, 'user_id', 'id');
    }

    /**
     * Many-to-Many relations with the user model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function restaurants()
    {
        return $this->belongsToMany( Config::get( 'restauranter.restaurant_model' ),Config::get( 'restauranter.restaurant_staff_table' ), 'user_id', 'restaurant_id' )->withTimestamps();
    }

    /**
     * has-one relation with the current selected team model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function currentRestaurant()
    {
        return $this->hasOne( Config::get( 'restauranter.restaurant_model' ), 'id', 'current_restaurant_id' );
    }

    /**
     * @return mixed
     */
    public function ownedRestaurants()
    {
        return $this->restaurants()->where( "owner_id", "=", $this->getKey() );
    }

}
