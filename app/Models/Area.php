<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $fillable = [
        'author_id', 'name', 'thana_id', 'status', 'slug', 'bn_name'
    ];
    public function thana() {
        return $this->belongsTo(Thana::class, 'thana_id', 'id');
    }
}
