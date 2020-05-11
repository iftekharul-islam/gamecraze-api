<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\BaseController;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class UserController extends BaseController
{
    private $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $users = $this->userRepository->all();
        return response()->json($users);
    }

    public function show()
    {
        $user = $this->userRepository->findById();
        return response()->json($user);
    }

    public function createRole(Request $request)
    {
        $this->userRepository->createRole($request);
        return response()->json(['message' => 'Role Successfully saved!']);
    }
    public function showRole()
    {
        $roles = $this->userRepository->showRole();
        return response()->json($roles);
    }

    public function createPermission(Request $request)
    {
        $this->userRepository->createPermission($request);
        return response()->json(['message' => 'Permission Successfully saved!']);
    }

    public function showPermission()
    {
        $permissions = $this->userRepository->showPermission();
        return response()->json($permissions);
    }

    public function rolehasPermission($role_id, $per_id)
    {
        $this->userRepository->rolehasPermission($role_id, $per_id);
        return response()->json('this role get the permission successfully');
    }

    public function userhasRole($user_id, $role_id)
    {
        $this->userRepository->userhasRole($user_id, $role_id);
        return response()->json('User get the Role successfully');
    }

    public function userhasPermission($user_id, $per_id)
    {
        $this->userRepository->userhasPermission($user_id, $per_id);
        return response()->json('User get the Permission successfully');
    }
}
