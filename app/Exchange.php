<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exchange extends Model
{
    public function lender() {
        return $this->belongsTo(User::class);
    }

    public function borrower() {
        return $this->belongsTo(User::class);
    }

    public function game() {
        return $this->belongsTo(Game::class);
    }
}
