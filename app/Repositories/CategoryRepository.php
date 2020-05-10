<?php

namespace App\Repositories;

use App\Category;
use Illuminate\Http\Request;

class CategoryRepository {
    public function all() {
        return Category::all();
    }

    public function findById($id) {
        return Category::findOrFail($id);
    }

    public function create(Request $request) {
        $category = new Category();
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->save();

        return $category;
    }

    public function update(Request $request) {
        $category = Category::findOrFail($request->id);
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->save();

        return $category;
    }

    public function delete($id) {
        $category = Category::findOrFail($id);
        $category->delete();
        return;
    }
}
