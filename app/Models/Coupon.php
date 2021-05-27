<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = [
        'name', 'code', 'amount', 'amount_type', 'user_type', 'set_user_id',
        'limit', 'start_date', 'end_date', 'status', 'author_id'
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'set_user_id');
    }
}
