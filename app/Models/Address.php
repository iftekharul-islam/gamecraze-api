<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = ['address', 'user_id',];

    public function user() {
        return $this->hasOne(User::class);
    }
}
