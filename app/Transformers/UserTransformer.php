<?php

namespace App\Transformers;

// We need to reference the Items Model
use App\Models\User;

// Dingo includes Fractal to help with transformations
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
//    protected $defaultIncludes = ['roles'];
    public function transform(User $user)
    {
        // specify what elements are going to be visible to the API
        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'phone_number' => $user->phone_number,
            'gender' => $user->gender,
            'birth_date' => $user->birth_date,
            'address' => $user->address,
            'roles' => $user->roles,
            'rent_limit' => $user->rent_limit,
            'is_phone_verified' => $user->is_phone_verified,
            'image' => $user->image ? asset($user->image) : '',
            'cover' => $user->cover ? $user->cover : '',
            'identification_number' => $user->identification_number,
            'identification_image' => $user->identification_image ? asset($user->identification_image) : '',
            'is_verified' => $user->is_verified,
            'last_name' => $user->last_name,
            'id_verified' => $user->id_verified,
            'referral_code' => $user->referral_code,
            'referred_by' => $user->referred_by,
            'referral_url' => env('GAMEHUB_FRONT').'/login?referred_code='.$user->referral_code,
            'achieve_discount' => $user->achieve_discount
        ];
    }

}
