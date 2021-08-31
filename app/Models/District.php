<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class District extends Model
{
    protected $fillable = [
        'author_id', 'name', 'division_id', 'status', 'slug', 'bn_name'
    ];

    protected static function boot() {
        parent::boot();

        static::creating(function ($district) {
            $district->slug = Str::slug($district->name);
        });

        static::updating(function ($district) {
            $district->slug = Str::slug($district->name);
        });
    }

    public function division() {
        return $this->belongsTo(Division::class);
    }
}
