<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vendor extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'shop_name',
        'trade_license',
        'shop_description',
        'cover_photo',
        'profile_photo',
        'is_verified',
        'status'
    ];

    public function phoneNumbers() {
        return $this->hasMany(PhoneNumber::class, 'user_id', 'id');
    }

    public function addresses() {
        return $this->hasMany(Address::class, 'user_id', 'id');
    }
}
