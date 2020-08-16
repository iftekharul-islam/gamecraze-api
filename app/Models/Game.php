<?php

namespace App\Models;

use Cviebrock\EloquentTaggable\Taggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Game extends Model
{
    use Taggable, SoftDeletes;

    protected $fillable = [
        'name', 'author_id', 'description', 'released', 'rating', 'base_price_id', 'is_trending', 'publisher', 'developer'
    ];
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
        return $this->belongsToMany(Platform::class);
    }
    public function basePrice() {
        return $this->hasOne(BasePrice::class,'id','base_price_id');
    }
}
