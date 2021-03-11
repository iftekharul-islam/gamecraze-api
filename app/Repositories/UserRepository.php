<?php

namespace App\Repositories;

use App\Http\Requests\UserCreateRequest;
use App\Models\Address;
use App\Models\User;
use Dingo\Api\Exception\UpdateResourceFailedException;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use File;

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

        $address = Address::create([
            'address' => null,
            'city' => null,
            'post_code' => null
        ]);
        $user->address_id = $address->id;
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

        $user->rent_limit = 2;
        $user->status = 1;
        $role = Role::where('name', 'customer')->first();
        if ($role) {
            $user->assignRole($role);
        }

        $address = Address::create([
            'address' => null,
            'city' => null,
            'post_code' => null
        ]);
        
        $user->address_id = $address->id;

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
            if (isset($userData['last_name'])) {
                $user->last_name = $userData['last_name'];
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
            if (isset($userData['identification_number'])) {
                $user->identification_number = $userData['identification_number'];
            }
            if (isset($userData['id_image'])) {
                if (!File::isDirectory(storage_path('app/public/identification'))){
                    File::makeDirectory(storage_path('app/public/identification'), 0777, true, true);
                }
                $image = $userData['id_image'];
                $userImage = 'id_' . time() . '_' . $user->id . '.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
                \Image::make($image)->save(storage_path('app/public/identification/') . $userImage);
                $user->identification_image = 'storage/identification/' . $userImage;
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
                if (!File::isDirectory(storage_path('app/public/profile'))){
                    File::makeDirectory(storage_path('app/public/profile'), 0777, true, true);
                }

                // if ($user->image) {
                //     deleteFile([$user->image]);
                // }

                $image = $userData['image'];
                $userImage = 'profile_' . time() . '_' . $user->id . '.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
                \Image::make($image)->save(storage_path('app/public/profile/') . $userImage);
                $user->image = 'storage/profile/' . $userImage;
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

    public function updateProfileImage($data) {
        $user = User::findOrFail(auth()->user()->id);
        if (isset($data['image']) && isset($data['image_type'])) {
            if (!File::isDirectory(storage_path('app/public/profile'))){
                File::makeDirectory(storage_path('app/public/profile'), 0777, true, true);
            }

            if ($data['image_type'] == 'profile' && $user->image) {
                deleteFile([$user->image]);
            }

            if ($data['image_type'] == 'cover' && $user->cover) {
                deleteFile([$user->cover]);
            }

            $image = $data['image'];
            $userImage = 'profile_' . time() . '_' . $user->id . '.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];

            if ($data['image_type'] == 'profile') {
                $user->image = 'storage/profile/' . $userImage;
                \Image::make($image)
                    ->resize(null, 256, function ($constraint) {
                        $constraint->aspectRatio();
                    })
                    ->save(storage_path('app/public/profile/') . $userImage);
            }
            if ($data['image_type'] == 'cover') {
                $user->cover = 'storage/profile/' . $userImage;
                \Image::make($image)
                ->resize(null, 370, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(storage_path('app/public/profile/') . $userImage);
            }

            $user->save();
            return $user;
        }

        return null;
    }
}
