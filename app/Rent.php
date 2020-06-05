<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rent extends Model
{
    public function game() {
        return $this->belongsTo(Game::class);
    }
}
