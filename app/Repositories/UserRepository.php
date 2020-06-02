<?php

namespace App\Repositories;

use App\Http\Requests\UserCreateRequest;
use App\User;
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
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->phone_number = $request->phone_number;
        $user->gender = $request->gender;
        $user->birth_date = $request->birth_date;
        $user->address = $request->address;
        $user->interest = $request->interest;

        if(isset($request->image))
        {
            $exploded = explode(',', $request->image);
            $decoded = base64_decode($exploded[1]);
            $ageinExploded = explode(';', $exploded[0]);
            $type = explode('/', $ageinExploded[0]);
            $extension = $type[1];
            $randomName = Str::random();
            $imageName = $randomName.'.'.$extension;

            $path = public_path().'/'.$imageName;
            file_put_contents($path, $decoded);
            $user->image = $path;
        }
        $user->save();

        return response()->json(compact('user'), 201);
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
