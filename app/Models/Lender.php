<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lender extends Model
{
    use SoftDeletes;
    protected $fillable = ['lender_id', 'rent_post_id', 'lend_week', 'lend_cost', 'lend_date', 'payment_method', 'status'];

    public function rentPost() {
        return $this->hasOne(Rent::class,'id','rent_post_id');
    }

    public function lender() {
        return $this->hasOne(User::class,'id','lender_id');
    }
}
