<?php

namespace App\Repositories;

use App\Http\Requests\UserCreateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;


class UserRepository {
    public function all() {
        return User::all();
    }

    public function findById() {
        return User::findOrFail(auth()->user()->id);
    }

    public function create(Request $request) {
        $user = User::create($request->all());

        return response()->json($user, 201);
    }

    public function update(Request$request) {
        $userData = $request->all();
        $user = User::where('phone_number', $userData['phone_number'])->first();

        if (isset($userData['email'])) {
            $user->email = $userData['email'];
        }
        if (isset($userData['password'])) {
            $user->password = bcrypt($userData['password']);
        }

        $user->save();

        return $user;
    }

    public function delete($id) {
        $user = User::findOrFail($id);
        $user->delete();

        return;
    }

    public function createRole(Request $request)
    {
        Role::create([
            'name' => $request->name,
        ]);
        return;
    }

    public function showRole()
    {
        return Role::all();
    }

    public function createPermission(Request $request)
    {
        Permission::create([
            'name' => $request->name,
        ]);
        return;
    }

    public function showPermission()
    {
        return Permission::all();
    }

    public function rolehasPermission($role_id,$per_id)
    {
        $permission = Permission::findById($per_id);
        $role = Role::findById($role_id);

        $role->givePermissionTo($permission);

        return;
    }

    public function userhasRole($user_id, $role_id)
    {
        $role = Role::findById($role_id);
        $user = User::find($user_id);

        $user->assignRole($role);
        return;
    }

    public function userhasPermission($user_id, $per_id)
    {
        $permission = Permission::findById($per_id);
        $user = User::find($user_id);

        $user->givePermissionTo($permission);
        return;
    }
}
