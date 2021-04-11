<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\GameReminderCreateRequest;
use App\Repositories\GameReminderRepository;
use Illuminate\Http\Request;

class GameReminderController extends Controller
{
    public $repository;

    public function __construct(GameReminderRepository $repository) {
        $this->repository = $repository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $game_id)
    {
        if ($this->repository->checkIfExists(auth()->user()->id, $game_id)) {
            return responseData('Reminder already set', 200);
        }

        $reminder = $this->repository->create($request->game_id, auth()->user()->id);
        if ($reminder)  {
            return responseData('Added to reminder', 200);
        }

        return responseData('Could not set reminder', 200);
    }

    public function destroy(Request $request, $game_id)
    {
        if ($this->repository->checkIfExists(auth()->user()->id, $game_id)) {
            $removeReminder = $this->repository->destroyReminder(auth()->user()->id, $game_id);
            if ($removeReminder == true){
                return responseData('Reminder removed successfully', 200);
            }
            return responseData('Reminder Could not remove', 200);
        }

        return responseData('Could not find reminder', 200);
    }

    public function checkReminder($game_id)
    {
        if ($this->repository->checkIfExists(auth()->user()->id, $game_id)) {
            return [
                'reminder' => true,
                'message' => "Reminder already set"
            ];
        }
        return [
            'reminder' => false,
            'message' => "Reminder not set"
        ];

    }
}
