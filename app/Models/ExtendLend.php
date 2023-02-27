<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExtendLend extends Model
{
    protected $fillable = [
        'lend_id', 'user_id', 'week', 'amount', 'commission',
    ];

    public function lend() {
        return $this->hasOne(Lender::class, 'id', 'lend_id');
    }

    public function user() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
