<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WithdrawRequest extends Model
{
    protected $fillable = [
        'user_id', 'amount', 'status'
    ];

    public function user() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
