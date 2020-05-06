<?php

namespace App\Http\Controllers\API;

use App\Category;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class CategoryController extends BaseController
{
    public function index() {
        $categories = Category::all();
        return response()->json(compact('categories'), 200);
    }

    public function show(Request $request) {
        $category = Category::findOrFail($request->id);
        return response()->json(compact('category'), 200);
    }

    public function store(Request $request) {
        $category = new Category();
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->save();
    }

    public function update(Request $request) {
        $category = Category::findOrFail($request->id);
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->save();
    }

    public function destroy(Request $request) {
        $category = Category::findOrFail($request->id);
        $category->delete();
    }
}
