<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Thana extends Model
{
    protected $fillable = [
        'author_id', 'name', 'district_id', 'status', 'slug', 'bn_name'
    ];

    protected static function boot() {
        parent::boot();

        static::creating(function ($thana) {
            $thana->slug = Str::slug($thana->name);
        });

        static::updating(function ($thana) {
            $thana->slug = Str::slug($thana->name);
        });
    }

    public function district() {
        return $this->belongsTo(District::class, 'district_id', 'id');
    }
}
