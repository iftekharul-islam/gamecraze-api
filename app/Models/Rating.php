<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = [
        'lend_id', 'lender_id', 'renter_id', 'lender_rating', 'renter_rating',
        'lender_comment', 'renter_comment', 'notify_lender', 'notify_renter'
    ];

    public function lend()
    {
        return $this->belongsTo(Lender::class, 'lend_id', 'id');
    }

    public function lender()
    {
        return $this->hasOne(User::class, 'id', 'lender_id');
    }

    public function renter()
    {
        return $this->hasOne(User::class, 'id', 'renter_id');
    }
}
