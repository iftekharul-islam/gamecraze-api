<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $fillable = [
        'name', 'author_id', 'slug'
    ];
    public function games()
    {
        return $this->belongsToMany(Game::class);
    }
}
