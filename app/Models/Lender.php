<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lender extends Model
{
    use SoftDeletes;
    protected $fillable = ['lender_id', 'rent_id', 'lend_week', 'lend_cost', 'lend_date', 'payment_method', 'status'];

    public function rent() {
        return $this->hasOne(Rent::class, 'id', 'rent_id');
    }
}