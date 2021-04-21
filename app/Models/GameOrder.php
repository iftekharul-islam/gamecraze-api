<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GameOrder extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'order_no', 'user_id', 'amount', 'commission', 'payment_method', 'payment_status',
        'delivery_charge', 'delivery_status', 'address', 'wallet_amount'
    ];

    public function lenders()
    {
        return $this->hasMany(Lender::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
