<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rent extends Model
{
    use SoftDeletes;

    protected $fillable = [
       'user_id', 'game_id', 'availability', 'max_week', 'platform_id', 'checkpoint_id', 'earning_amount', 'rented_lend_id',
        'disk_condition_id', 'cover_image', 'disk_image', 'rented_user_id', 'status', 'reason', 'disk_type', 'game_user_id', 'game_password', 'status_by_user'
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
    public function lend() {
        return $this->hasOne(Lender::class, 'id','rented_lend_id');
    }
    public function checkpoint() {
        return $this->belongsTo(Checkpiont::class, 'checkpoint_id', 'id');
    }
    public function renter() {
        return $this->hasOne(User::class, 'id', 'rented_user_id');
    }
}
