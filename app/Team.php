<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function players()
    {
        return $this->hasMany(Player::class);
    }

    /**
     * @param array $data
     *
     * @return \App\Player
     */
    public function addPlayer(array $data): Player
    {
        return $this->players()
            ->create($data);
    }
}
