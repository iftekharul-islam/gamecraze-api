<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Product extends Model implements HasMedia
{
    use HasMediaTrait;
    use SoftDeletes;

    protected $fillable = [
        'sub_category_id',
        'name',
        'description',
        'price',
        'is_negotiable',
        'product_type',
        'is_sold',
        'product_no',
        'used_year',
        'used_month',
        'used_day',
        'warranty_availability',
        'warranty_year',
        'warranty_month',
        'warranty_day',
        'email',
        'user_id',
        'status',
        'author_id',
        'phone_no',
        'address',
        'condition_summary',
        'reason',
        'area',
        'thana_id'
    ];

    protected static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub

        Product::creating(function ($product){
            $product->author_id = Auth::user()->id;
        });

        Product::updating(function ($product){
            $product->author_id = Auth::user()->id;
        });
    }

    public function user() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function subcategory() {
        return $this->hasOne(SubCategory::class, 'id', 'sub_category_id');
    }

    public function thana() {
        return $this->belongsTo(Thana::class, 'thana_id', 'id');
    }
}
