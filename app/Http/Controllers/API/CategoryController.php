<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\BaseController;
use App\Http\Requests\CategoryCreateRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;

class CategoryController extends BaseController
{
    private $categoryRepository;
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function index() {
        $categories = $this->categoryRepository->all();
        return response()->json(compact('categories'), 200);
    }

    public function show(Request $request) {
        $category = $this->categoryRepository->findById($request->id);
        return response()->json(compact('category'), 200);
    }

    public function store(CategoryCreateRequest $request) {
        $category = $this->categoryRepository->create($request);
        return response()->json(compact('category'), 200);
    }

    public function update(CategoryUpdateRequest $request) {
        $category = $this->categoryRepository->update($request);
        return response()->json(compact('category'), 200);
    }

    public function destroy(Request $request) {
        $this->categoryRepository->delete($request->id);

    }
}
