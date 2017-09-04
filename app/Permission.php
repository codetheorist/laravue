<?php

namespace App;

use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission
{
    public function category()
    {
        return $this->belongsTo(PermissionCategory::class, 'permission_category_id', 'id');
    }
}
