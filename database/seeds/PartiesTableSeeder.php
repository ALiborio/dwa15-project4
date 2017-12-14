<?php

use Illuminate\Database\Seeder;
use GameMaster\Party;

class PartiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $generator = new \Nubs\RandomNameGenerator\Alliteration();
        for ($i=0; $i < 5; $i++) {
            Party::insert([
                'created_at' => Carbon\Carbon::now()->subHour($i)->toDateTimeString(),
                'updated_at' => Carbon\Carbon::now()->subHour($i)->toDateTimeString(),
                'name' => $generator->getName(),
                'description' => 'A new party!',
                'user_id' => 1
        ]);
        }
    }
}
