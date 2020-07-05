<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Http\Requests\RentCreateRequest;
use App\Http\Requests\RentUpdateRequest;
use App\Transformers\RentTransformer;
use App\Repositories\RentRepository;
use Dingo\Api\Exception\DeleteResourceFailedException;
use Dingo\Api\Exception\UpdateResourceFailedException;
use Illuminate\Support\Facades\Storage;

class RentController extends BaseController
{
    /**
     * @var RentRepository
     */
    private $rentRepository;

    /**
     * RentController constructor.
     * @param RentRepository $rentRepository
     */
    public function __construct(RentRepository $rentRepository)
    {
        $this->rentRepository = $rentRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $rents = $this->rentRepository->all();
        return $this->response->collection($rents, new RentTransformer());
    }

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param RentCreateRequest $request
	 *
	 * @return \Illuminate\Http\Response
	 */
    public function store(RentCreateRequest $request)
    {
        $cover_image = $request->hasFile('cover_image') ? Storage::disk('public')->put('rent-image/' , $request->file('cover_image')) : null;
        $disk_image = $request->hasFile('disk_image') ? Storage::disk('public')->put('rent-image/' , $request->file('disk_image')) : null;
        $rent = $this->rentRepository->store($request, $cover_image, $disk_image);
        return $this->response->item($rent, new RentTransformer());
    }

	/**
	 * @param $id
	 *
	 * @return \Dingo\Api\Http\Response
	 */
    public function show($id)
    {
        $rent = $this->rentRepository->show($id);
        return $this->response->item($rent, new RentTransformer());
    }

    /**
     * @param RentUpdateRequest $request
     *
     * @return \Dingo\Api\Http\Response
     */
    public function update(RentUpdateRequest $request)
    {

	    $rents = $this->rentRepository->update($request);

	    if ($rents === false) {
	    	throw new UpdateResourceFailedException("Id is missing");
	    }

	    return $this->response->item($rents, new RentTransformer());
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $status = $this->rentRepository->delete($id);
        if ($status == 0) {
            throw new DeleteResourceFailedException();
        }

        return $this->response->array([
            "status_code" => 200,
            "message" => "Resource has been deleted."
        ]);
    }
}
