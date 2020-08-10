<?php


namespace App\Repositories\Admin;


use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserRepository
{

    public function user(){
        return User::with('roles')->whereHas('roles', function ($query) {
            return $query->where('name','!=', 'admin');
        })->get();
    }

     public function findById($id){
            return User::with('roles', 'address')->findOrFail($id);
    }

    public function store($request){
        $data = $request->only(['name', 'email', 'phone_number', 'status']);
        $data['password'] = Hash::make($request->password);
        $user = User::create($data);
        $role = Role::where('name', 'customer')->first();
        if ($user && $role) {
            $user->assignRole($role);
            return $user;
        }
    }

}
