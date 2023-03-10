<?php

namespace App\Repositories;

use App\Models\Address;
use App\Models\User;
use App\Models\UserVendor;
use App\Models\Vendor;
use Dingo\Api\Exception\UpdateResourceFailedException;
use File;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserRepository
{
    public function all()
    {
        return User::all();
    }

    public function findById($id)
    {
        return User::where('id', $id)->first();
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
        if (isset($userData['referral'])) {
            $user->referred_by = $userData['referral'];
        }

        $user->rent_limit = config('gamehub.rent_limit');;
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

        $user->referral_code = 'GH-'.rand(1000, 9999).'-'.$user->id;
        $user->save();

        if(isset($userData['shopName']) && isset($userData['tradeLicense'])){
            $vendor = Vendor::create([
                'shop_name' =>  $userData['shopName'],
                'trade_license' =>  $userData['tradeLicense'],
                'is_verified' => false,
                'status' => true
            ]);
            logger('$vendor');
            logger($vendor);

            $role = Role::where('name', 'vendor_admin')->first();

            $user->assignRole($role);

            UserVendor::create([
                'user_id' =>  $user->id,
                'vendor_id' =>  $vendor->id,
                'role_id' =>  $role->id,
            ]);
        }

        return [
            'error' => false,
            'user' => $user,
        ];
    }

    public function update(Request $request)
    {
        $userData = $request->all();
        logger($userData);
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
            if (isset($userData['address'])) {
                $address = Address::updateOrCreate([
                    'id'   => $user->address_id
                ],[
                    'address' => $userData['address']
                ]);
                $user->address_id = $address->id;
            }
            if (isset($userData['password'])) {
                $user->password = bcrypt($userData['password']);
            }
            if (isset($userData['image'])) {
                if (!File::isDirectory(storage_path('app/public/profile'))){
                    File::makeDirectory(storage_path('app/public/profile'), 0777, true, true);
                }

                $image = $userData['image'];
                $userImage = 'profile_' . time() . '_' . $user->id . '.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
                \Image::make($image)->save(storage_path('app/public/profile/') . $userImage);
                $user->image = 'storage/profile/' . $userImage;
            }

            $user->save();

            if(isset($userData['shopName']) && isset($userData['tradeLicense'])){
                $vendor = Vendor::create([
                    'shop_name' =>  $userData['shopName'],
                    'trade_license' =>  $userData['tradeLicense'],
                    'is_verified' => false,
                    'status' => true
                ]);
                logger('$vendor');
                logger($vendor);

                $role = Role::where('name', 'vendor_admin')->first();

                $user->assignRole($role);

                UserVendor::create([
                    'user_id' =>  $user->id,
                    'vendor_id' =>  $vendor->id,
                    'role_id' =>  $role->id,
                ]);
            }

            $user['address'] = $user->address;
            $user['referral_url'] = env('GAMEHUB_FRONT').'/login?referred_code='.$user->referral_code;

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
