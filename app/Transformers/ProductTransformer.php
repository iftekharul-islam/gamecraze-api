<?php

namespace App\Transformers;

// We need to reference the Items Model
use App\Models\Product;

// Dingo includes Fractal to help with transformations
use League\Fractal\TransformerAbstract;

class ProductTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['user', 'subcategory', 'thana'];

    public function transform(Product $product)
    {
        // specify what elements are going to be visible to the API
        return [
            'id' => $product->id,
            'name' => $product->name,
            'url_name' => urlencode(strtolower($product->name)),
            'product_no' => $product->product_no,
            'sub_category_id' =>  $product->sub_category_id,
            'description' =>  $product->description,
            'price' => ceil($product->price),
            'is_sold' => $product->is_sold,
            'is_negotiable' => $product->is_negotiable,
            'product_type' => $product->product_type,
            'used_year' => $product->used_year,
            'used_month' => $product->used_month,
            'used_day' => $product->used_day,
            'warranty_availability' =>$product->warranty_availability,
            'warranty_year' =>$product->warranty_year,
            'warranty_month' =>$product->warranty_month,
            'warranty_day' =>$product->warranty_day,
            'condition' => $product->condition_summary,
            'status' =>  $product->status,
            'user_id' => $product->user_id,
            'created_at' => $product->created_at,
            'cover' => $this->coverImage($product),
            'images' => $this->productImages($product),
            'phone_no' => $product->phone_no,
            'address' => $product->address,
            'slider' => $this->sliderImages($product),
            'email' => $product->email,
            'area' => $product->area,
            'thana_id' => $product->thana_id,
            'reason' => $product->reason
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

    public function includeThana(Product $product) {
        if (isset($product->thana)) {
            return $this->item($product->thana, new ThanaTransformer());
        }
    }

    public function coverImage($product)
    {
        $collection = $product->getMedia('cover-image');
        $image = null;
        if (count($collection) > 0) {
            $image = [
                'id' => $collection[0]->id,
                'url' => asset('storage/' . $collection[0]->id . '/' . $collection[0]->file_name)
            ];
        }
        return $image;
    }
    public function productImages($product)
    {
        $collection = $product->getMedia('product-image');
        $images = [];
        if (count($collection) > 0){
            foreach ($collection as $item) {
                $images[] = [
                    'id' => $item->id,
                    'url' => asset('storage/' . $item->id . '/' . $item->file_name)
                ];
            }
        }
        return $images;
    }

    public function sliderImages($product)
    {
        $collection = $product->getMedia('product-image');
        $images = [];
        if (count($collection) > 0){
            foreach ($collection as $item) {
                $images[] = [
                    'id' => $item->id,
                    'src' => asset('storage/' . $item->id . '/' . $item->file_name),
                    'thumbnail' => asset('storage/' . $item->id . '/' . $item->file_name)
                ];
            }
        }
        return $images;
    }
}
