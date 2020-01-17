<?php

namespace AttendanceSystem\Http\Controllers;

use AttendanceSystem\Http\Requests\RoleRequest;
use AttendanceSystem\Models\Permission;
use AttendanceSystem\Models\Role;
use AttendanceSystem\Repositories\RoleRepository;
use Illuminate\Http\Request;

class RoleController extends BaseController
{
    private $roleRepository;

    public function __construct(RoleRepository $roleRepository)
    {
        parent::__construct();
        $this->roleRepository = $roleRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = $this->roleRepository->getRoleWithPermission();

        return view('role.index', ['roles' => $roles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permission_list = Permission::all();

        return view('role.create', ['permissions' => $permission_list]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  RoleRequest  $request
     * @param Role $role
     * @return mixed
     */
    public function store(RoleRequest $request, Role $role)
    {
        $result = $this->roleRepository->store($request, $role);

        if($result) {
            return redirect()->route('role.index')->with(['success' => "Успешно сохранено"]);
        } else {
            return back()->withErrors(['msg' => "Ошибка сохранения"])->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = $this->roleRepository->getById($id);

        return view('role.edit', ['role' => $role]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  RoleRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, $id)
    {
        $role = Role::find($id);

        if(empty($role)) {
            return back()->withErrors(['msg' => "Запись id =[{$id}] не найдена"])->withInput();
        }

        $result = $this->roleRepository->update($request, $role);

        if($result) {
            return redirect()->route('role.edit', $role->id)->with(['success' => "Успешно сохранено"]);
        } else {
            return back()->withErrors(['msg' => "Ошибка сохранения"])->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        if($id != 1) {

            $role = Role::find($id);

            $role->delete();

            return redirect()->route('role.index')->withStatus(__('Role successfully deleted.'));

        } else {

            return redirect()->route('role.index')->withStatus(__('This role cannot be deleted.'));

        }



    }
}
