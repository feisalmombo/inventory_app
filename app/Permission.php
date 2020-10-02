<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Role;

class Permission extends Model
{
    public function Roles(){
        return $this->belongsToMany(Role::class,'roles_permissions');
    }
}
