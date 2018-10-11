<?php

namespace Tests\Feature\API;

use App\Team;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TeamsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var Team
     */
    protected $team;

    /**
     * @before
     */
    public function setUp()
    {
        parent::setUp();

        $this->team = factory(Team::class)->create();
    }

    /**
     * @test
     * @covers ::index
     */
    public function itCanRetrieveTeams()
    {
        $this->getJson(route('api.teams.index'))
            ->assertStatus(200)
            ->assertJsonStructure([
                [
                    'id',
                    'name',
                ],
            ]);
    }

    /**
     * @test
     * @covers ::store
     */
    public function itFailsStoreTeamValidation()
    {
        $data = [
            'name' => '',
        ];

        $this->postJson(route('api.teams.store'), $data)
            ->assertStatus(422);
    }

    /**
     * @test
     * @covers ::store
     */
    public function itCanStoreTeams()
    {
        $data = [
            'name' => 'Test',
        ];

        $this->postJson(route('api.teams.store'), $data)
            ->assertStatus(201)
            ->assertJsonStructure([
                'id',
                'name',
            ])
            ->assertJsonFragment([
                'name' => 'Test',
            ]);
    }

    /**
     * @test
     * @covers ::show
     */
    public function itCanShowTeams()
    {
        $this->getJson(route('api.teams.show', ['team' => $this->team->id]))
            ->assertStatus(200)
            ->assertJsonStructure([
                'id',
                'name',
            ]);
    }

    /**
     * @test
     * @covers ::show
     */
    public function itCanUpdateTeams()
    {
        $data = [
            'name' => 'New Name',
        ];

        $this->putJson(route('api.teams.update', ['team' => $this->team->id]), $data)
            ->assertStatus(200)
            ->assertJsonStructure([
                'id',
                'name',
            ])
            ->assertJsonFragment([
                'name' => 'New Name',
            ]);
    }

    /**
     * @test
     * @covers ::show
     */
    public function itCanDeleteTeams()
    {
        $this->deleteJson(route('api.teams.destroy', ['team' => $this->team->id]))
            ->assertStatus(204);
    }
}
