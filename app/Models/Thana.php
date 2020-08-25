<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Thana extends Model
{
    protected $fillable = [
        'author_id', 'name', 'district_id', 'status', 'slug',
    ];
    public function district() {
        return $this->belongsTo(District::class, 'district_id', 'id');
    }
}
