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

    public function getWithRoles() {

        return $this->model->with(['roles'])->get();

    }

    public function store($request, $permission) {

        $data = $request->all();
        $encode = json_encode($data['routes']);
        $data['routes'] = $encode;

        $result = $permission->fill($data)->save();

        return ($result) ? true : false;

    }

    public function update($request, $permission) {

        $data = $request->all();
        $encode = json_encode($data['routes']);
        $data['routes'] = $encode;

        $result = $permission->update($data);

        return ($result) ? true : false;
    }
}
