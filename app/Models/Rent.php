<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rent extends Model
{
    use SoftDeletes;

    protected $fillable = [
       'user_id', 'game_id', 'availability', 'max_week', 'platform_id', 'earning_amount',
        'disk_condition_id', 'cover_image', 'disk_image', 'rented_user_id', 'status', 'reason'
    ];

    public function game() {
        return $this->belongsTo(Game::class);
    }
    public function user() {
        return $this->belongsTo(User::class);
    }
    public function platform() {
        return $this->belongsTo(Platform::class);
    }
    public function diskCondition() {
        return $this->belongsTo(DiskCondition::class);
    }
}
