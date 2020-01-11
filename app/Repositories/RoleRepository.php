<?php
namespace AttendanceSystem\Repositories;

use AttendanceSystem\Models\Role;
use AttendanceSystem\Repositories\BaseRepository;

class RoleRepository extends BaseRepository {

    public function __construct(Role $role)
    {
       $this->model = $role;
    }

}
