<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VideoUrl extends Model
{
    protected $fillable = [
        'game_id', 'name', 'url'
    ];

    public function game()
    {
        return $this->belongsTo(Game::class,'game_id','id');
    }
}
