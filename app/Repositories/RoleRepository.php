<?php
namespace AttendanceSystem\Repositories;

use AttendanceSystem\Models\Role;
use AttendanceSystem\Repositories\BaseRepository;

class RoleRepository extends BaseRepository {

    public function __construct(Role $role)
    {
       $this->model = $role;
    }

    public function getRoleWithPermission() {

        return $this->model->with(['permissions'])->get();
    }

    public function store($request, $role) {

        $data = $request->all();

        $result = $role->fill($data)->save();

        $permissions = $request->all()['permissions'];

        $role->permissions()->attach($permissions);

        return ($result) ? true : false;
    }

    public function update($request, $role) {

        $data = $request->all();

        $result = $role->update($data);

        $permissions = $request->all()['permissions'];

        $role->permissions()->sync($permissions);

        return ($result) ? true : false;
    }

}
