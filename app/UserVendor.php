<?php

namespace App;

use App\Models\Vendor;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

class UserVendor extends Model
{
    protected $fillable = [
        'user_id', 'vendor_id', 'role_id'
        ];

    public function user() {
        return $this->hasOne(User::class, 'user_id', 'id');
    }

    public function vendor() {
        return $this->hasOne(Vendor::class, 'id', 'vendor_id');
    }

    public function role() {
        return $this->hasOne(Role::class, 'id', 'role_id');
    }
}
