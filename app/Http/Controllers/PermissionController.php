<?php

namespace AttendanceSystem\Http\Controllers;

use AttendanceSystem\Http\Requests\PermissionRequest;
use AttendanceSystem\Models\Permission;
use AttendanceSystem\Models\Role;
use AttendanceSystem\Repositories\PermissionRepository;
use Illuminate\Http\Request;

class PermissionController extends BaseController
{
    private $permissionRepository;

    public function __construct(PermissionRepository $permissionRepository)
    {
        parent::__construct();
        $this->permissionRepository = $permissionRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = $this->permissionRepository->getWithRoles();

        return view('permission.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $routes = app()->routes->getRoutes();

        return view('permission.create', compact('routes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PermissionRequest  $request
     * @param Permission $permission
     * @return \Illuminate\Http\Response
     */
    public function store(PermissionRequest $request, Permission $permission)
    {

       $result = $this->permissionRepository->store($request, $permission);

        if($result) {
            return redirect()->route('permission.index')->with(['success' => "Успешно сохранено"]);
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
        $permission = $this->permissionRepository->getById($id);

        $routes = app()->routes->getRoutes();

        return view('permission.edit', ['permission' => $permission, 'routes' => $routes]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  PermissionRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PermissionRequest $request, $id)
    {
        $permission = Permission::find($id);

        if(empty($permission)) {
            return back()->withErrors(['msg' => "Запись id =[{$id}] не найдена"])->withInput();
        }

       $result = $this->permissionRepository->update($request, $permission);

        if($result) {
            return redirect()->route('permission.edit', $permission->id)->with(['success' => "Успешно сохранено"]);
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
        $permission = Permission::find($id);

        $permission->delete();

        return redirect()->route('permission.index')->withStatus(__('Permission successfully deleted.'));
    }
}
