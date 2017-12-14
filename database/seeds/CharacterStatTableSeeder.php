<?php

use Illuminate\Database\Seeder;
use GameMaster\Character;
use GameMaster\Profession;
use GameMaster\Race;
use GameMaster\Stat;

class CharacterStatTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stats = Stat::all();
        $characters = Character::with(['profession.stats', 'race.stats'])->get();
        foreach ($characters as $character) {
            $statList = $character->generateStats($stats);
            $character->stats()->sync($statList);
        }
    }
}
