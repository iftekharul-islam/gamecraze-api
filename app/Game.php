<?php

namespace App;

use Cviebrock\EloquentTaggable\Taggable;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use Taggable;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function assets(){
        return $this->hasMany(Asset::class);
    }
}
