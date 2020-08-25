<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $fillable = [
        'author_id', 'name', 'division_id', 'status', 'slug',
    ];

    public function division() {
        return $this->belongsTo(Division::class);
    }
}
