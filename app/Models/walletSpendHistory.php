<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class walletSpendHistory extends Model
{
    protected $fillable = ['user_id', 'order_id', 'amount', 'reason', 'status'];
}
