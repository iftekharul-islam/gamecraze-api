<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Http\Requests\RentCreateRequest;
use App\Http\Requests\RentUpdateRequest;
use App\Models\Game;
use App\Models\Rent;
use App\Transformers\RentTransformer;
use App\Repositories\RentRepository;
use Dingo\Api\Exception\DeleteResourceFailedException;
use Dingo\Api\Exception\UpdateResourceFailedException;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

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
        if ($rents) {
            return $this->response->collection($rents, new RentTransformer());
        }

        return responseData('No post found', 404);

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

    public function rentPostedUsers($slug) {
        $rents = $this->rentRepository->rentPostedUsers($slug);
        return $this->response->collection($rents, new RentTransformer());
    }

    public function checkRented(Request $request) {
        $ids = $request->ids;
        $data = [];

        foreach ($ids as $id) {
            $value = Rent::where('id', $id)
                ->where('rented_user_id', '!=', null)
                ->first();

            if ($value) {
                $item = Game::where('id', $value->game_id)->first();
                $data[] = $item->name;
            }
        }
        $data = implode(', ', $data);

        return response()->json(compact('data'), 200);

    }

    public function offerPercentage()
    {
        $offerAmount = config('gamehub.offer_amount');

        return response()->json(compact('offerAmount'), 200);
    }

    public function updateCredential(Request $request)
    {
        $data = Rent::find($request->rent_id);
        if ($data) {
            $data->game_user_id = $request->game_user_id;
            $data->game_password = $request->game_password;

            $data->save();

            return $this->response->array([
                'error' => false,
                'message' => 'Rent games user credential updated'
            ]);
        }

        return $this->response->array([
            'error' => true,
            'message' => 'Rent id not match'
        ]);

    }

    public function gameExistInRent($slug)
    {
        $game = Game::where('slug', $slug)->first();
        $data = Rent::where('game_id', $game->id)->count();

        return response()->json(compact('data'), 200);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function postStatusUpdate(Request $request)
    {
        $post = Rent::find($request->id);
        if ($post) {
            $post->status_by_user = $request->status;
            $post->save();

            return $this->response->array([
                'error' => false,
                'message' => 'Rent post status updated'
            ]);
        }

        return $this->response->array([
            'error' => true,
            'message' => 'Rent post status cannot update'
        ]);
    }

}
