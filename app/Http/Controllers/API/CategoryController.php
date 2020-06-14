<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Repositories\CategoryRepository;
use App\Transformers\GenreTransformer;

class CategoryController extends BaseController
{
    private $categoryRepository;
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function index($genreName) {
        $genre = $this->categoryRepository->index($genreName);
        return $this->response->collection($genre, new GenreTransformer());
    }
}
