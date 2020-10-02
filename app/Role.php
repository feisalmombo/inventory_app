<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Permissions\HasPermissionsTrait;

use App\Permission;

class Role extends Model
{
	use HasPermissionsTrait;
	
    public function permissions(){
        return $this->belongsToMany(Permission::class,'roles_permissions');
        
    }
}
