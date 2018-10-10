<?php

namespace Tests\Unit;

use App\Player;
use App\Team;
use Tests\TestCase;

class TeamTest extends TestCase
{
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
     */
    public function itCanAddPlayerToTeam()
    {
        $player = $this->team->addPlayer([
            'first_name' => 'Justin',
            'last_name'  => 'Zablocki',
        ]);

        $this->assertInstanceOf(Player::class, $player);
        $this->assertEquals($this->team->id, $player->team_id);
    }
}
