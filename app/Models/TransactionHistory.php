<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionHistory extends Model
{
    protected $fillable = [
        'user_id', 'amount', 'description', 'author_id', 'payment_type', 'post_id'
    ];

    public function author()
    {
        return $this->hasOne(User::class, 'id', 'author_id');
    }
}
