<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Permission;

class PermissionCategory extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'display_name', 'description',
    ];

    public function permissions()
    {
        return $this->hasMany(Permission::class, 'permission_category_id', 'id');
    }
}
