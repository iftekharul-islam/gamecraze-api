<?php

namespace App\Transformers;

// We need to reference the Items Model
use App\User;

// Dingo includes Fractal to help with transformations
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    public function transform(User $user)
    {
        // specify what elements are going to be visible to the API
        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
        ];
    }
}
