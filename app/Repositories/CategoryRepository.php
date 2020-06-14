<?php

namespace App\Repositories;

use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryRepository {
    public function index($genreName) {
        $slug = Str::slug($genreName);
        return Genre::where('slug', $slug)->get();
    }
}
