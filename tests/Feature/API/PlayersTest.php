<?php

namespace Tests\Feature\API;

use App\Player;
use App\Team;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PlayersTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var Team
     */
    protected $team;

    /**
     * @var Player
     */
    protected $player;

    /**
     * @before
     */
    public function setUp()
    {
        parent::setUp();

        $this->team   = factory(Team::class)->create();
        $this->player = factory(Player::class)->create([
            'team_id' => $this->team->id,
        ]);
    }

    /**
     * @test
     */
    public function itCanGetAllPlayersForTeam()
    {
        $this->getJson(route('api.teams.players.index', ['team' => $this->team->id]))
            ->assertStatus(200)
            ->assertJsonStructure([
                [
                    'id',
                    'first_name',
                    'last_name',
                ],
            ]);
    }

    /**
     * @test
     */
    public function itFailsToStoreInvalidPlayer()
    {
        $data = [];

        $this->postJson(route('api.teams.players.store', ['team' => $this->team->id]), $data)
            ->assertStatus(422);
    }

    /**
     * @test
     */
    public function itStoresPlayerForTeam()
    {
        $data = [
            'first_name' => 'Justin',
            'last_name'  => 'Zablocki',
        ];

        $this->postJson(route('api.teams.players.store', ['team' => $this->team->id]), $data)
            ->assertStatus(201)
            ->assertJsonStructure([
                'id',
                'team_id',
                'first_name',
                'last_name',
            ])
            ->assertJsonFragment([
                'team_id'    => $this->team->id,
                'first_name' => 'Justin',
                'last_name'  => 'Zablocki',
            ]);
    }

    /**
     * @test
     */
    public function itShowsPlayers()
    {
        $this->getJson(route('api.players.show', ['player' => $this->player->id]))
            ->assertStatus(200)
            ->assertJsonStructure([
                'id',
                'team_id',
                'first_name',
                'last_name',
            ]);
    }

    /**
     * @test
     */
    public function itUpdatesPlayers()
    {
        $data = [
            'first_name' => 'New',
            'last_name'  => 'Name',
        ];

        $this->putJson(route('api.players.update', ['player' => $this->player->id]), $data)
            ->assertStatus(200)
            ->assertJsonStructure([
                'id',
                'team_id',
                'first_name',
                'last_name',
            ])
            ->assertJsonFragment([
                'first_name' => 'New',
                'last_name'  => 'Name',
            ]);
    }

    /**
     * @test
     */
    public function itDeletesPlayers()
    {
        $this->deleteJson(route('api.players.destroy', ['player' => $this->player->id]))
            ->assertStatus(204);

        $this->assertDatabaseMissing('players', [
            'id' => $this->player->id,
        ]);
    }
}
