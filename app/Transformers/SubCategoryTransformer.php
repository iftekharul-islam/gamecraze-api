<?php

namespace App\Transformers;

// We need to reference the Items Model
use App\Models\Game;
use App\Models\Rent;

// Dingo includes Fractal to help with transformations
use App\Models\SubCategory;
use App\Repositories\Admin\RentRepository;
use App\Repositories\Admin\BasePriceRepository;
use League\Fractal\TransformerAbstract;

class SubCategoryTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['category'];

    public function transform(SubCategory $subCategory)
    {
        // specify what elements are going to be visible to the API
        return [
            'id' => $subCategory->id,
            'name' => $subCategory->name,
            'category_id' =>  $subCategory->category_id,
            'image_url' =>  $subCategory->image_url != null ? asset($subCategory->image_url) : null,
            'status' =>  $subCategory->status,
        ];
    }

    public function includeCategory(SubCategory $subCategory) {
        if (isset($subCategory->category)) {
            return $this->item($subCategory->category, new CategoryTransformer());
        }
    }

}
