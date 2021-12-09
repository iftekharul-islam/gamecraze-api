<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = ['user_id', 'title', 'address', 'state', 'city', 'zip_code'];

    public function user() {
        return $this->hasOne(User::class);
    }
}
