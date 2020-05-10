<?php

namespace App\Repositories;

use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserRepository {
    public function all() {
        return User::all();
    }

    public function findById() {
        return User::findOrFail(auth()->user()->id);
    }

    public function create(Request $request) {
        return User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
    }

    public function update(Request$request, $userId) {
        $user = User::findOrFail($userId);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        return;
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
