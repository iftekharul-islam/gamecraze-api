<?php

namespace App\Transformers;

// We need to reference the Items Model
use App\Models\Asset;

// Dingo includes Fractal to help with transformations
use Illuminate\Support\Facades\Storage;
use League\Fractal\TransformerAbstract;
use Spatie\Permission\Models\Role;

class RoleTransformer extends TransformerAbstract
{
    public function transform(Role $role)
    {
        // specify what elements are going to be visible to the API
        return [
            'id' => $role->id,
            'name' => $role->name,
            'guard_name' => $role->guard_name,
        ];
    }
}
