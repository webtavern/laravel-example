<?php

namespace AttendanceSystem\Http\Controllers;


use AttendanceSystem\Models\Role;
use AttendanceSystem\Models\User;
use AttendanceSystem\Http\Requests\UserRequest;
use AttendanceSystem\Repositories\UserRepository;


class UserController extends Controller
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the users
     *
     * @param  UserRepository $userRepository
     * @return \Illuminate\View\View
     */
    public function index(UserRepository $userRepository)
    {
        $routes = app()->routes->getRoutes();

        $users = $userRepository->getUsersWithRolesAndPermissions();

        return view('users.index', ['users' => $users, 'routes' => $routes]);
    }

    /**
     * Show the form for creating a new user
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $role_list = Role::all();

        return view('users.create', ['roles' => $role_list]);
    }

    /**
     * Store a newly created user in storage
     *
     * @param  \AttendanceSystem\Http\Requests\UserRequest  $request
     * @param  \AttendanceSystem\Models\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserRequest $request, User $user)
    {
        $this->userRepository->store($request, $user);

        return redirect()->route('user.index')->withStatus(__('User successfully created.'));
    }

    /**
     * Show the form for editing the specified user
     *
     * @param  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $user = $this->userRepository->getById($id);

        $role_list = Role::all();

        return view('users.edit', ['user' => $user, 'roles' => $role_list]);
    }

    /**
     * Update the specified user in storage
     *
     * @param  \AttendanceSystem\Http\Requests\UserRequest  $request
     * @param  \AttendanceSystem\Models\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserRequest $request, User $user)
    {
        $this->userRepository->update($request, $user);

        return redirect()->route('user.index')->withStatus(__('User successfully updated.'));
    }

    /**
     * Remove the specified user from storage
     *
     * @param  \AttendanceSystem\Models\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('user.index')->withStatus(__('User successfully deleted.'));
    }
}
