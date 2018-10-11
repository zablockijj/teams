<?php

namespace App\Http\Controllers\API\Team;

use App\Http\Requests\Players\StoreRequest;
use App\Http\Resources\PlayerResource;
use App\Team;
use App\Http\Controllers\Controller;

class PlayerController extends Controller
{
    /**
     * @param \App\Team $team
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Team $team)
    {
        return PlayerResource::collection(
            $team->players
        );
    }

    /**
     * @param \App\Http\Requests\Players\StoreRequest $request
     * @param \App\Team                               $team
     *
     * @return \App\Http\Resources\PlayerResource
     */
    public function store(StoreRequest $request, Team $team)
    {
        $player = $team->addPlayer($request->validated());

        return new PlayerResource($player);
    }
}
