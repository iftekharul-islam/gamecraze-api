<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class walletSpendHistory extends Model
{
    protected $fillable = ['user_id', 'order_id', 'amount', 'reason', 'status'];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function order()
    {
        return $this->hasOne(GameOrder::class, 'id', 'order_id');
    }
}
