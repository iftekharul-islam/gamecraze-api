<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OneTimePassword extends Model
{
    protected $fillable = ['phone_number', 'otp'];
}
