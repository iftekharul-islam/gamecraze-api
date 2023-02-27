<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BasePrice extends Model
{
    protected $fillable = ['author_id', 'start', 'end', 'base', 'second_week', 'third_week', 'status'];
}
