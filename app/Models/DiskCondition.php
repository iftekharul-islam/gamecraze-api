<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DiskCondition extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'author_id', 'name', 'description', 'status'
    ];

    public function rents(){
        return $this->hasMany(Rent::class);
    }
}
