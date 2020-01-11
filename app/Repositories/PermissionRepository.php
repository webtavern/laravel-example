<?php


namespace AttendanceSystem\Repositories;

use AttendanceSystem\Models\Permission;
use AttendanceSystem\Repositories\BaseRepository;

class PermissionRepository extends BaseRepository
{
    public function __construct(Permission $permission)
    {
        $this->model = $permission;
    }
}
