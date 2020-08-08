<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GameMode extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'author_id', 'name', 'status', 'slug'
    ];

    public function games()
    {
        return $this->belongsToMany(Game::class);
    }
}
