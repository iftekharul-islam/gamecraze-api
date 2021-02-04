<?php


namespace App\Repositories\Admin;


use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserRepository
{

    public function user($number = 20) {
        return User::with('roles')->whereHas('roles', function ($query) {
            return $query->where('name','!=', 'admin');
        })->orderBy('created_at', 'DESC')
        ->paginate($number);
    }

    public function findById($id) {
        return User::with('roles', 'address')->findOrFail($id);
    }

    public function edit($id) {
        return  User::findOrFail($id);
    }

    public function update($request) {
        $user =  User::findOrFail($request->id);
        $data = $request->only(['name', 'email', 'phone_number', 'password', 'status', 'confirmPassword']);

        if (isset($data['name'])) {
            $user->name = $data['name'];
        }
        if (isset($data['email'])) {
            $user->email = $data['email'];
        }
         if (isset($data['phone_number'])) {
            $user->phone_number = $data['phone_number'];
        }
        if (isset($data['password'])) {
            $user->password = Hash::make($user['password']);
        }
        if (isset($data['status'])) {
            $user->status = $data['status'];
        }
        $user->save();
    }

    public function store($request) {
        $data = $request->only(['name', 'email', 'phone_number', 'status']);
        $data['password'] = Hash::make($request->password);
        $user = User::create($data);
        $role = Role::where('name', 'customer')->first();
        if (!$role) {
            $role = Role::create(['name' => 'customer']);
        }
        if ($user && $role) {
            $user->assignRole($role);
            return $user;
        }
    }

}
