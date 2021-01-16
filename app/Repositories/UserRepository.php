<?php

namespace App\Repositories;

use App\Http\Requests\UserCreateRequest;
use App\Models\Address;
use App\Models\User;
use Dingo\Api\Exception\UpdateResourceFailedException;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;

class UserRepository
{
    public function all()
    {
        return User::all();
    }

    public function findById()
    {
        return User::findOrFail(auth()->user()->id);
    }

    public function create(Request $request)
    {
        $user = User::create($request->all());
        $role = Role::where('name', 'customer')->first();

        if ($user && $role) {
            $user->assignRole($role);
            return $user;
        }
        return false;
    }

    public function emailRegistration($request)
    {
        $userData = $request->all();
        $data = User::where('phone_number', $request->phone_number)->first();
        if ($data) {
            return [
                'error' => true,
                'message' => 'Phone Number already exists',
            ];
        }
        $user = new User();

        if (isset($userData['name'])) {
            $user->name = $userData['name'];
        }
        if (isset($userData['lastName'])) {
            $user->last_name = $userData['lastName'];
        }
        if (isset($userData['email'])) {
            $user->email = $userData['email'];
        }
        if (isset($userData['phone_number'])) {
            $user->phone_number = $userData['phone_number'];
        }
        if (isset($userData['password'])) {
            $user->password = bcrypt($userData['password']);
        }
        $user->save();

        return [
            'error' => false,
            'user' => $user,
        ];
    }

    public function update(Request $request)
    {
        $userData = $request->all();

        $user = auth()->user();
        if (!$user) {
            $user = User::when($userData['phone_number'], function($query) use($userData) {
                    $query->where('phone_number', $userData['phone_number']);
                })
                ->when($userData['email'], function($query) use($userData) {
                    $query->where('email', $userData['email']);
                })
                ->first();
        }

        if ($user) {
            if (isset($userData['name'])) {
                $user->name = $userData['name'];
            }
            if (isset($userData['lastName'])) {
                $user->last_name = $userData['lastName'];
            }
            if (isset($userData['email'])) {
                $user->email = $userData['email'];
            }
            if (isset($userData['phone_number'])) {
                $user->phone_number = $userData['phone_number'];
                if ($user->phone_number != $userData['phone_number']) {
                    $user->is_phone_verified = 0;
                }
            }
            if (isset($userData['gender'])) {
                $user->gender = $userData['gender'];
            }
            if (isset($userData['birth_date'])) {
                $user->birth_date = $userData['birth_date'];
            }
            if (isset($userData['id_number'])) {
                $user->identification_number = $userData['id_number'];
            }
            if (isset($userData['id_image'])) {
                $image = $userData['id_image'];
                $userImage = 'id_' . time() . '_' . $user->id . '.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
                \Image::make($image)->save(storage_path('app/public/identification/') . $userImage);
                $user->identification_image = 'identification/' . $userImage;
            }
            if (isset($userData['address']) || isset($userData['city']) || isset($userData['postCode'])) {
                $address = Address::find($user->address_id);
                $address->address = $userData['address'];
                $address->city = $userData['city'];
                $address->post_code = $userData['postCode'];
                $address->save();
            }
            if (isset($userData['password'])) {
                $user->password = bcrypt($userData['password']);
            }
            if (isset($userData['image'])) {
                $image = $userData['image'];
                $userImage = 'profile_' . time() . '_' . $user->id . '.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
                \Image::make($image)->save(storage_path('app/public/profile/') . $userImage);
                $user->image = 'profile/' . $userImage;
            }

            $user->save();

            $user['address'] = $user->address;
            return $user;
        }

        throw new UpdateResourceFailedException();

    }

    public function delete($id)
    {
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

    public function rolehasPermission($role_id, $per_id)
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

    public function checkPassword(Request $request)
    {
        return User::where('email', $request->input('email'))->where('password', null)->first();
    }

    public function checkEmailExist(Request $request)
    {
        return User::where('email', $request->input('email'))->first();
    }
}
