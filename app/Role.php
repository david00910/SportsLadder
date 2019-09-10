<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function permissions() {
        $this->belongsToMany('App\Permission', 'role_has_permissions', 'role_id', 'permission_id' );
    }

    public function users() {
        $this->belongsToMany('App\User', 'model_has_roles', 'role_id', 'model_id');
    }

}
