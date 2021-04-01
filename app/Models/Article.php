<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = ['thumbnail', 'title', 'slug', 'description', 'user_id', 'status', 'is_featured'];
}
