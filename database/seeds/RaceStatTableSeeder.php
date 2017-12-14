<?php

use Illuminate\Database\Seeder;
use GameMaster\Race;
use GameMaster\Stat;

class RaceStatTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $races = [
            'human' => [
                'intelligence' => 1,
                'charisma' => 1
            ],
            'elf' => [
                'dexterity' => 1,
                'wisdom' => 1
            ],
            'dwarf' => [
                'strength' => 1,
                'constitution' => 1
            ],
        ];

        foreach ($races as $name => $attributes) {
            $race = Race::where('name', 'LIKE', $name)->first();
            foreach ($attributes as $statName => $modifier) {
                $stat = Stat::where('name', 'LIKE', $statName)->first();
                $statList[$stat->id] = ['modifier' => $modifier];
            }
            dump($statList);
            $race->stats()->sync($statList);
            unset($statList);
        }
    }
}
