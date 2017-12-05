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
        for ($i=0; $i < 20; $i++) { 
            if ($i % 2 == 0) {
                $gender = 'male';
            } else {
                $gender = 'female';
            }

            switch (rand(1,3)) {
                case 1:
                    $lawfulness = 'lawful';
                    break;
                case 2:
                    $lawfulness = 'neutral';
                    break;
                case 3:
                    $lawfulness = 'chaotic';
                    break;
            }

            switch (rand(1,3)) {
                case 1:
                    $morality = 'good';
                    break;
                case 2:
                    $morality = 'neutral';
                    break;
                case 3:
                    $morality = 'evil';
                    break;
            }

            Character::insert([
                'created_at' => Carbon\Carbon::now()->subHour($i)->toDateTimeString(),
                'updated_at' => Carbon\Carbon::now()->subHour($i)->toDateTimeString(),
                'name' => $generator->getName(),
                'gender' => $gender,
                'race_id' => rand(1,3),
                'class_id' => rand(1,10),
                'level' => 1,
                'lawfulness' => $lawfulness,
                'morality' => $morality
        ]);
        }
    }
}
