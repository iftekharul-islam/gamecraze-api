<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Platform extends Model
{
    protected $fillable = [
        'author_id', 'name', 'status', 'url', 'slug', 'is_featured'
    ];

    public function games() {
        return $this->belongsToMany(Game::class)->withPivot(['requirements','released_at']);
    }
    public function rent() {
        return $this->hasOne(Rent::class);
    }
}
