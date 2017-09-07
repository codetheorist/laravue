<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    public $timestamps = false;

    protected $fillable = [
      'street', 'town', 'city', 'country', 'postcode', 'place'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
