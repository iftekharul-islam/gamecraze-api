<?php

namespace App\Transformers;

// We need to reference the Items Model
use App\Models\Game;
use App\Models\Rent;

// Dingo includes Fractal to help with transformations
use App\Models\UserVendor;
use App\Models\Vendor;
use App\Repositories\Admin\RentRepository;
use App\Repositories\Admin\BasePriceRepository;
use League\Fractal\TransformerAbstract;

class UserVendorTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['user', 'vendor', 'role'];


    public function transform(UserVendor $userVendor): array
    {
        // specify what elements are going to be visible to the API
        return [
            'id' => $userVendor->id,
            'user_id' => $userVendor->user_id,
            'vendor_id' =>  $userVendor->vendor_id,
            'role_id' =>  $userVendor->role_id,
            'created_at' =>  $userVendor->created_at,
            'Updated_at' =>  $userVendor->Updated_at,
        ];
    }

    public function includeUser(UserVendor $userVendor) {
        if (isset($userVendor->user)) {
            return $this->item($userVendor->user, new UserTransformer());
        }
    }

    public function includeVendor(UserVendor $userVendor) {
        if (isset($userVendor->vendor)) {
            return $this->item($userVendor->vendor, new VendorTransformer());
        }
    }

    public function includeRole(UserVendor $userVendor) {
        if (isset($userVendor->role)) {
            return $this->item($userVendor->role, new RoleTransformer());
        }
    }
}
