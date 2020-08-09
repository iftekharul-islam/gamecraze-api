<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Http\Requests\RentCreateRequest;
use App\Http\Requests\RentUpdateRequest;
use App\Transformers\RentTransformer;
use App\Repositories\RentRepository;
use Dingo\Api\Exception\DeleteResourceFailedException;
use Dingo\Api\Exception\UpdateResourceFailedException;
use Illuminate\Http\Request;

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
     * @return \Dingo\Api\Http\Response
     */
    public function allRent() {
        $rents = $this->rentRepository->allRent();
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
        $rent = $this->rentRepository->store($request);
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

    public function cartItems(Request $request) {
        $ids = explode(',', $request->ids);
        $rents = $this->rentRepository->cartItems($ids);
        return $this->response->collection($rents, new RentTransformer());
    }

    public function rentPostedUsers($id) {
        $rents = $this->rentRepository->rentPostedUsers($id);
        return $this->response->collection($rents, new RentTransformer());
    }
}
