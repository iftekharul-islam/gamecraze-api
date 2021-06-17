<?php

namespace App\Transformers;

// We need to reference the Items Model
use App\Models\Game;
use App\Models\Product;
use App\Models\Rent;

// Dingo includes Fractal to help with transformations
use App\Models\SubCategory;
use App\Repositories\Admin\RentRepository;
use App\Repositories\Admin\BasePriceRepository;
use League\Fractal\TransformerAbstract;

class ProductTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['user', 'subcategory'];

    public function transform(Product $product)
    {
        // specify what elements are going to be visible to the API
        return [
            'id' => $product->id,
            'name' => $product->name,
            'product_no' => $product->product_no,
            'sub_category_id' =>  $product->category_id,
            'description' =>  $product->description,
            'price' => $product->price,
            'is_sold' => $product->is_sold,
            'is_negotiable' => $product->is_negotiable,
            'product_type' => $product->product_type,
            'status' =>  $product->status,
            'user_id' => $product->user_id,
            'created_at' => $product->created_at,
        ];
    }

    public function includeSubcategory(Product $product) {
        if (isset($product->subcategory)) {
            return $this->item($product->subcategory, new SubCategoryTransformer());
        }
    }

    public function includeUser(Product $product) {
        if (isset($product->user)) {
            return $this->item($product->user, new UserTransformer());
        }
    }
}
