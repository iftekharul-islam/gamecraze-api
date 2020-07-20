<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Http\Requests\GenreCreateRequest;
use App\Http\Requests\GenreUpdateRequest;
use App\Repositories\GenreRepository;
use App\Transformers\GenreTransformer;
use Dingo\Api\Exception\DeleteResourceFailedException;
use Dingo\Api\Exception\StoreResourceFailedException;
use Dingo\Api\Exception\UpdateResourceFailedException;
use Dingo\Api\Http\Response;
use http\Env\Request;

class GenreController extends BaseController
{
    /**
     * @var GenreRepository
     */
    private $genreRepository;

    /**
     * GenreController constructor.
     * @param GenreRepository $genreRepository
     */
    public function __construct(GenreRepository $genreRepository)
    {
        $this->genreRepository = $genreRepository;
    }

    /**
     * @return Response
     */
    public function index() {
        $genres = $this->genreRepository->all();
        return $this->response->collection($genres, new GenreTransformer());
    }

    /**
     * @param $id
     * @return Response
     */
    public function show($id) {
        $genre = $this->genreRepository->findById($id);
        return $this->response->item($genre, new GenreTransformer());
    }

    /**
     * @param GenreCreateRequest $request
     * @return Response
     */
    public function store(GenreCreateRequest $request) {
        $genre = $this->genreRepository->create($request);
        if (!$genre) {
            throw new StoreResourceFailedException();
        }
        return $this->response->item($genre, new GenreTransformer());
    }

    /**
     * @param GenreUpdateRequest $request
     * @return Response
     */
    public function update(GenreUpdateRequest $request) {
        $genre = $this->genreRepository->update($request);
        if (!$genre) {
            throw new UpdateResourceFailedException();
        }
        return $this->response->item($genre, new GenreTransformer());
    }

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id) {
        $status = $this->genreRepository->delete($id);
        if ($status == 0) {
            throw new DeleteResourceFailedException();
        }

        return $this->response->array([
            "status_code" => 200,
            "message" => "Resource has been deleted."
        ]);
    }
}
