<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['name', 'email', 'phone', 'amount', 'address', 'status', 'transaction_id', 'currency', 'created_at'];
}
