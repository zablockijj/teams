<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\Players\UpdateRequest;
use App\Http\Resources\PlayerResource;
use App\Player;
use App\Http\Controllers\Controller;

class PlayerController extends Controller
{
    /**
     * @param \App\Player $player
     *
     * @return \App\Http\Resources\PlayerResource
     */
    public function show(Player $player)
    {
        return new PlayerResource($player);
    }

    /**
     * @param \App\Http\Requests\Players\UpdateRequest $request
     * @param \App\Player                              $player
     *
     * @return \App\Http\Resources\PlayerResource
     */
    public function update(UpdateRequest $request, Player $player)
    {
        $player->fill($request->validated());
        $player->save();

        return new PlayerResource($player);
    }

    /**
     * @param \App\Player $player
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Player $player)
    {
        $player->delete();

        return response()->json([], 204);
    }
}
