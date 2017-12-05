<?php

use Illuminate\Database\Seeder;
use GameMaster\Character;
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
        $characters = Character::all();
        foreach ($characters as $character) {
            foreach ($stats as $stat) {
                $statList[$stat->id] = ['value' => rand(1,20)];
            }
            $character->stats()->sync($statList);
        }
    }
}
