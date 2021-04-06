<?php


namespace App\Repositories\Admin;


use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserRepository
{

    public function user($request)
    {

        $user = User::query();

        if ($request->user_type == 1) {
            $user->where('is_verified', $request->user_type);
        }
        if ($request->user_type != 1 && $request->user_type != null) {
            $user->where('is_verified', 0);
        }

        if ($request->search) {
            $user->where('phone_number', 'LIKE', "%{$request->search}%")
                ->orWhere('email', 'LIKE', "%{$request->search}%");
        }

        return $user->with('roles')->whereHas('roles', function ($query) {
            $query->where('name', '!=', 'admin');
        })->orderBy('created_at', 'DESC')
            ->paginate(config('gamehub.pagination'));
    }

    public function findById($id) {
        return User::with('roles', 'address')->findOrFail($id);
    }

    public function edit($id) {
        return  User::findOrFail($id);
    }

    public function update($request) {
        $user =  User::findOrFail($request->id);
        $data = $request->only(['name', 'email', 'phone_number', 'password', 'status', 'is_verified', 'confirmPassword', 'identification_number', 'identification_image']);

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
            $user->password = Hash::make($data['password']);
        }
        if (isset($data['is_verified'])) {
            $user->is_verified = $data['is_verified'];
        }
        if (isset($data['status'])) {
            $user->status = $data['status'];
        }
        $user->save();
    }

    public function store($request) {
        $data = $request->only(['name', 'email', 'phone_number', 'is_verified', 'rent_limit', 'status']);

        $data['password'] = Hash::make($request->password);
        $data['rent_limit'] = 2;

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

    public function idVerification($id)
    {
        $user = User::find($id);
        if ($user){
            $user->id_verified = true;
            $user->save();
            return true;
        }

        return false;
    }

}
