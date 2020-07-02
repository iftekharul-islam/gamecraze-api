<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\BaseController;
use App\Http\Requests\PermissionCreateRequest;
use App\Http\Requests\RoleCreateRequest;
use App\Repositories\UserRepository;
use App\Transformers\UserTransformer;
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
        return $this->response->collection($users, new UserTransformer());
    }

    public function show()
    {
        $user = $this->userRepository->findById();
        return $this->response->item($user, new UserTransformer());
    }

    public function createRole(RoleCreateRequest $request)
    {
        $this->userRepository->createRole($request);
        return response()->json(['message' => 'Role Successfully saved!']);
    }
    public function showRole()
    {
        $roles = $this->userRepository->showRole();
        return response()->json($roles);
    }

    public function createPermission(PermissionCreateRequest $request)
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

    public function profile() {
        $user = auth('api')->user();
        return $this->response->item($user, new UserTransformer());
    }
}
