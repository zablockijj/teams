<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\Teams\StoreRequest;
use App\Http\Requests\Teams\UpdateRequest;
use App\Http\Resources\TeamResource;
use App\Team;
use App\Http\Controllers\Controller;

class TeamController extends Controller
{
    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return TeamResource::collection(
            Team::all()
        );
    }

    /**
     * @param \App\Http\Requests\Teams\StoreRequest $request
     *
     * @return \App\Http\Resources\TeamResource
     */
    public function store(StoreRequest $request)
    {
        $team = Team::create($request->validated());

        return new TeamResource($team);
    }

    /**
     * @param \App\Team $team
     *
     * @return \App\Http\Resources\TeamResource
     */
    public function show(Team $team)
    {
        $team->load('players');

        return new TeamResource($team);
    }

    /**
     * @param \App\Http\Requests\Teams\UpdateRequest $request
     * @param \App\Team                              $team
     *
     * @return \App\Http\Resources\TeamResource
     */
    public function update(UpdateRequest $request, Team $team)
    {
        $team->fill($request->validated());
        $team->save();

        return new TeamResource($team);
    }

    /**
     * @param \App\Team $team
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Team $team)
    {
        $team->delete();

        return response()->json([], 204);
    }
}
