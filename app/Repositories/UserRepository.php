<?php

namespace AttendanceSystem\Repositories;

use AttendanceSystem\Models\Role;
use AttendanceSystem\Models\User;
use Illuminate\Support\Facades\Hash;


class UserRepository extends BaseRepository
{
    /**
     * Create a new UserRepository instance.
     *
     * @param  User $user
     * @return void
     */
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function getUsersWithRolesAndPermissions() {

        return $this->model->with(['roles', 'permissions'])->get();

    }

    public function relationsProcessing($request, $user, $type) {

        $roles_id = $request->all()['roles'];

        switch ($type) {
            case 'store':
                $user->roles()->attach($roles_id);
                break;
            case 'update':
                $user->roles()->sync($roles_id);
        }

        $roles = Role::whereIn('id', $roles_id)->with(['permissions'])->get();

        foreach ($roles as $role) {
            foreach ($role->permissions as $permission) {
                $permissions_id[] = $permission->id;
            }
        }

        if(!empty($permissions_id)) {
            switch ($type) {
                case 'store':
                    $user->permissions()->attach($permissions_id);
                    break;
                case 'update':
                    $user->permissions()->sync($permissions_id);
                    break;
            }
        }

    }

    public function store($request, $user) {

        $created_user = $user->create($request->merge(['password' => Hash::make($request->get('password'))])->all());

        if(array_key_exists('roles', $request->all())) {
            $this->relationsProcessing($request, $created_user, 'store');
        }

    }

    public function update($request, $user) {

        $user->update(
            $request->merge(['password' => Hash::make($request->get('password'))])
                ->except([$request->get('password') ? '' : 'password']
                ));

        if(array_key_exists('roles', $request->all())) {
            $this->relationsProcessing($request, $user, 'update');
        } else {
            $user->roles()->detach();
        }

    }

}
