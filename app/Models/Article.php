<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = ['thumbnail', 'title', 'description', 'user_id', 'status'];
}
