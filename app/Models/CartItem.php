<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $fillable = [
        'rent_id', 'user_id', 'rent_week', 'address', 'status'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function rent() {
        return $this->belongsTo(Rent::class, 'rent_id', 'id');
    }
}
