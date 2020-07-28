<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Platform extends Model
{
    protected $fillable = [
        'author_id', 'name', 'status', 'slug',
    ];

    public function games() {
        return $this->belongsToMany(Game::class)->withPivot(['requirements','released_at']);
    }
}
