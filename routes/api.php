<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('teams', 'TeamController');

Route::prefix('teams')
    ->namespace('Team')
    ->as('teams.')
    ->group(function () {
        Route::apiResource('{team}/players', 'PlayerController')
            ->only('index', 'store');
    });

Route::apiResource('players', 'PlayerController')
    ->only('show', 'update', 'destroy');
