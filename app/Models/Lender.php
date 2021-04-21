<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lender extends Model
{
    use SoftDeletes;

    protected $fillable = ['lender_id', 'rent_id', 'checkpoint_id', 'lend_week', 'lend_cost',
        'commission', 'renter_id', 'lend_date', 'payment_method', 'status', 'game_order_id',
        'discount_amount', 'reference', 'original_commission'];

//    public function renter() {
//        return $this->belongsTo(User::class,'renter_id','id');
//    }

    public function rent() {
        return $this->hasOne(Rent::class, 'id', 'rent_id');
    }

    public function lender() {
        return $this->hasOne(User::class,'id','lender_id');
    }

    public function order() {
        return $this->belongsTo(GameOrder::class, 'game_order_id', 'id');
    }
}
