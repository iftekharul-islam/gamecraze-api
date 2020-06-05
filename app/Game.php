<?php

namespace App;

use Cviebrock\EloquentTaggable\Taggable;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use Taggable;

    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }

    public function assets(){
        return $this->hasMany(Asset::class);
    }

    public function exchanges() {
        return $this->hasMany(Exchange::class);
    }
    public function rents() {
        return $this->hasMany(Rent::class);
    }
    public function platforms() {
        return $this->belongsToMany(Platform::class)->withPivot(['requirements','released_at']);
    }
}
