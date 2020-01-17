<?php

namespace AttendanceSystem\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = 'permissions';

    protected $fillable = [
        'name',
        'slug',
        'routes'
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class,'roles_permissions');
    }

    public function checkRoute($route) {

        $routes_arr = json_decode($this->routes);

        if(in_array($route, $routes_arr)) {
            return true;
        }

        return false;
    }
}
