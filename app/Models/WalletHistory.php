<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WalletHistory extends Model
{
    protected $fillable = ['user_id', 'referred_user_id', 'amount', 'reason'];

    public function User()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function referredUser()
    {
        return $this->hasOne(User::class, 'id', 'referred_user_id');
    }
}
