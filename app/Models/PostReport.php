<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostReport extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'name',
        'email',
        'phone_no',
        'reason',
        'image_url',
        'status',
    ];

    public function product() {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}
