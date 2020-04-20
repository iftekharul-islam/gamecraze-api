<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\BaseController;
use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends BaseController
{
    public function index()
    {
        $user = User::find(auth()->user()->id);

        if($user) {
            return response()->json($user);
        }

        return response()->json(['message' => 'User not found!'], 404);
    }

    public function show()
    {
        $user = User::all();

        return response()->json($user);
    }

    public function createRole(Request $request)
    {
        $role = Role::create([
        'name' => $request->name,
        ]);
        return response()->json(['message' => 'Role Successfully saved!']);
    }
    public function showRole(Request $request)
        {
            $role = Role::all();
            return response()->json($role);
        }

    public function createPermission(Request $request)
    {
        $role = Permission::create([
            'name' => $request->name,
        ]);
        return response()->json(['message' => 'Permission Successfully saved!']);
    }

    public function showPermission(Request $request)
    {
        $role = Permission::all();
        return response()->json($role);
    }

    public function rolehasPermission($role_id,$per_id)
    {
        $permission = Permission::findById($per_id);
        $role = Role::findById($role_id);

        $role->givePermissionTo($permission);

        return response()->json('this role get the permission successfully');
    }

    public function userhasRole($user_id, $role_id)
    {

        $role = Role::findById($role_id);
        $user = User::find($user_id);

        $user->assignRole($role);

        return response()->json('User get the Role successfully');
    }

    public function userhasPermission($user_id, $per_id)
    {

        $permission = Permission::findById($per_id);
        $user = User::find($user_id);

        $user->givePermissionTo($permission);

        return response()->json('User get the Permission successfully');
    }
}
