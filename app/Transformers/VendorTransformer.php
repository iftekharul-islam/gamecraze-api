<?php

namespace App\Transformers;

// We need to reference the Items Model
use App\Models\Game;
use App\Models\Rent;

// Dingo includes Fractal to help with transformations
use App\Models\Vendor;
use App\Repositories\Admin\RentRepository;
use App\Repositories\Admin\BasePriceRepository;
use League\Fractal\TransformerAbstract;

class VendorTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['phoneNumbers', 'addresses'];


    public function transform(Vendor $vendor): array
    {
        // specify what elements are going to be visible to the API
        return [
            'id' => $vendor->id,
            'shop_name' => $vendor->shop_name,
            'trade_license' =>  $vendor->trade_license,
            'shop_description' =>  $vendor->shop_description,
            'cover_photo' =>  $vendor->cover_photo ? asset($vendor->cover_photo) : '',
            'profile_photo' =>  $vendor->profile_photo ? asset($vendor->profile_photo) : '',
            'is_verified' =>  $vendor->is_verified,
            'status' =>  $vendor->status,
        ];
    }

    public function includePhoneNumbers(Vendor $vendor) {
        if (isset($vendor->phoneNumbers)) {
            return $this->item($vendor->phoneNumbers, new PhoneNumberTransformer());
        }
    }

    public function includeAddresses(Vendor $vendor) {
        if (isset($vendor->addresses)) {
            return $this->item($vendor->addresses, new AddressTransformer());
        }
    }
}
