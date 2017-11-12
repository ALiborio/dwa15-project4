<?php

use Illuminate\Database\Seeder;
use GameMaster\Character;

class CharactersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $generator = new \Nubs\RandomNameGenerator\Alliteration();
        for ($i=0; $i < 10; $i++) { 
            if ($i % 2 == 0) {
                $gender = 'male';
            } else {
                $gender = 'female';
            }
            Character::insert([
                'created_at' => Carbon\Carbon::now()->subHour($i)->toDateTimeString(),
                'updated_at' => Carbon\Carbon::now()->subHour($i)->toDateTimeString(),
                'name' => $generator->getName(),
                'gender' => $gender,
                'race_id' => rand(1,3),
                'class_id' => rand(1,10),
                'level' => 1,
                'strength' => rand(1,20),
                'dexterity' => rand(1,20),
                'constitution' => rand(1,20),
                'intelligence' => rand(1,20),
                'wisdom' => rand(1,20),
                'charisma' => rand(1,20)
        ]);
        }
    }
}
