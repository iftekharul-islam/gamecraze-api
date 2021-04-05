<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CoverImage extends Model
{
    protected $fillable = ['title','author_id', 'url', 'status'];
}
