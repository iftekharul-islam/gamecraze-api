<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BasePrice extends Model
{
    use SoftDeletes;

    protected $fillable = ['author_id', 'start', 'end', 'base', 'status'];
}
