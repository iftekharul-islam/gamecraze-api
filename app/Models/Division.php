<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    protected $fillable = [
        'author_id', 'name', 'status', 'slug',
    ];

    public function districts() {
        return $this->hasMany(District::class);
    }
}
