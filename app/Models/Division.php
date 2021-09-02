<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Division extends Model
{
    protected $fillable = [
        'author_id', 'name', 'status', 'slug', 'bn_name'
    ];

    protected static function boot() {
        parent::boot();

        static::creating(function ($division) {
            $division->slug = Str::slug($division->name);
        });

        static::updating(function ($division) {
            $division->slug = Str::slug($division->name);
        });
    }

    public function districts() {
        return $this->hasMany(District::class, 'division_id', 'id');
    }
}
