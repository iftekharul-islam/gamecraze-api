<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class SubCategory extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'category_id', 'name', 'description', 'image_url', 'status', 'author_id'
    ];

    protected static function boot()
    {
        parent::boot();

        SubCategory::creating(function ($subcategory){
            $subcategory->author_id = Auth::user()->id;
        });

        SubCategory::updating(function ($subcategory){
            $subcategory->author_id = Auth::user()->id;
        });
    }

    public function category() {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function products() {
        return $this->hasMany(Product::class, 'sub_category_id', 'id')
            ->where('status', 1)
            ->orderBy('updated_at', 'DESC');
    }
}
