<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Checkpiont extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'author_id', 'user_id', 'flat_no', 'house_no', 'road_no', 'block_no', 'area_id', 'availability_start_time', 'availability_end_time',
        'holiday', 'status', 'comment'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function area() {
            return $this->belongsTo(Area::class, 'area_id', 'id');
    }

}
