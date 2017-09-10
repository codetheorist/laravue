<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use Spatie\Activitylog\Traits\LogsActivity;

class Address extends Model implements AuditableContract
{
    use Auditable, LogsActivity;

    public $timestamps = false;

    protected $fillable = [
      'street', 'town', 'city', 'country', 'postcode', 'place'
    ];

    protected static $logAttributes = ['street', 'town', 'city', 'country', 'postcode', 'place'];

    protected static $logOnlyDirty = true;

    public function getLogNameToUse(string $eventName = ''): string
    {
       return 'addresses';
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
            return 'Address #' . $this->id . ' was created';
        }

        if ($eventName == 'updated')
        {
            return 'Address #' . $this->id . ' was updated';
        }

        if ($eventName == 'deleted')
        {
            return 'Address #' . $this->id . ' was deleted';
        }

        return '';
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
