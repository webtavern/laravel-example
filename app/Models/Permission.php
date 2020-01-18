<?php

namespace AttendanceSystem\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = 'permission';

    protected $fillable = [
        'name',
        'slug',
        'routes'
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class,'role_permission');
    }

    public function checkRoute($route) {

        $routes_arr = json_decode($this->routes);

        if(in_array($route, $routes_arr)) {
            return true;
        }

        return false;
    }
}
