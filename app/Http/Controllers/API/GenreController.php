<?php

namespace App\Http\Controllers\API;

use App\Genre;
use App\Http\Controllers\BaseController;
use App\Http\Requests\GenreCreateRequest;
use App\Http\Requests\GenreUpdateRequest;
use App\Repositories\GenreRepository;
use Illuminate\Http\Request;

class GenreController extends BaseController
{
    private $genreRepository;
    public function __construct(GenreRepository $genreRepository)
    {
        $this->genreRepository = $genreRepository;
    }

    public function index() {
        $genres = $this->genreRepository->all();
        return response()->json(compact('genres'), 200);
    }

    public function show(Request $request) {
        $genre = $this->genreRepository->findById($request->id);
        return response()->json(compact('genre'), 200);
    }

    public function store(GenreCreateRequest $request) {
        $genre = $this->genreRepository->create($request);
        return response()->json(compact('genre'), 200);
    }

    public function update(GenreUpdateRequest $request) {
        $genre = $this->genreRepository->update($request);
        return response()->json(compact('genre'), 200);
    }

    public function destroy(Request $request) {
        $this->genreRepository->delete($request->id);
    }
}
