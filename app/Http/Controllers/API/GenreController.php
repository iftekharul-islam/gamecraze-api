<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Http\Requests\GenreCreateRequest;
use App\Http\Requests\GenreUpdateRequest;
use App\Repositories\GenreRepository;
use App\Transformers\GenreTransformer;

class GenreController extends BaseController
{
    private $genreRepository;
    public function __construct(GenreRepository $genreRepository)
    {
        $this->genreRepository = $genreRepository;
    }

    public function index() {
        $genres = $this->genreRepository->all();
        return $this->response->collection($genres, new GenreTransformer());
    }

    public function show($id) {
        $genre = $this->genreRepository->findById($id);
        return $this->response->item($genre, new GenreTransformer());
    }

    public function store(GenreCreateRequest $request) {
        $genre = $this->genreRepository->create($request);
        return $this->response->item($genre, new GenreTransformer());
    }

    public function update(GenreUpdateRequest $request) {
        $genre = $this->genreRepository->update($request);
        return $this->response->item($genre, new GenreTransformer());
    }

    public function destroy($id) {
        $this->genreRepository->delete($id);
    }
}
