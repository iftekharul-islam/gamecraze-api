<?php

namespace App\Transformers;

// We need to reference the Items Model
use App\Models\Category;
use App\Models\Game;
use App\Models\Rent;

// Dingo includes Fractal to help with transformations
use App\Models\SubCategory;
use App\Repositories\Admin\RentRepository;
use App\Repositories\Admin\BasePriceRepository;
use League\Fractal\TransformerAbstract;

class CategoryTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['subcategory'];

    public function transform(Category $category)
    {
        // specify what elements are going to be visible to the API
        return [
            'id' => $category->id,
            'name' => $category->name,
            'status' =>  $category->status,
        ];
    }

    public function includeSubcategory(Category $category) {
        if (isset($category->subcategory)) {
            return $this->item($category->subcategory, new SubCategoryTransformer());
        }
    }
}
