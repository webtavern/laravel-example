<?php

namespace AttendanceSystem\Http\Controllers;

use AttendanceSystem\Models\Product;
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
        $roles = $this->roleRepository->index();

        return view('role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('role.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $role = new Role();
        $data = $request->all();
        $result = $role->fill($data)->save();

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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $role = Role::find($id);

        if(empty($role)) {
            return back()->withErrors(['msg' => "Запись id =[{$id}] не найдена"])->withInput();
        }

        $data = $request->all();

        $result = $role->fill($data)->save();

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
        $role = Role::find($id);

        $role->delete();

        return redirect()->route('role.index')->withStatus(__('Role successfully deleted.'));
    }
}
