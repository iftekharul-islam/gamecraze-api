<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Management extends Model
{
    protected $table ='managements';
    protected $fillable = [
        'user_id', 'delivery_type', 'delivery_amount', 'delivery_commission'
    ];

}
