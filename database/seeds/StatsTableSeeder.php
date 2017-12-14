<?php

use Illuminate\Database\Seeder;
use GameMaster\Stat;

class StatsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Stat::insert([
            'created_at' => Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
            'name' => 'Strength',
            'description' => 'Strength determines how hard a character can hit and how much they can carry. Strong characters do more damage with melee weapons and have greater range with thrown weapons.',
            'user_id' => 1
        ]);

        Stat::insert([
            'created_at' => Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
            'name' => 'Dexterity',
            'description' => 'Dexterity determines how agile and quick a character is. Dexterous characters move faster and have higher chance of dodging attacks.',
            'user_id' => 1
        ]);

        Stat::insert([
            'created_at' => Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
            'name' => 'Constitution',
            'description' => 'Constitution determines how much of a beating a character can withstand. Characters with a high constitution have higher health and are more resilient.',
            'user_id' => 1
        ]);

        Stat::insert([
            'created_at' => Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
            'name' => 'Intelligence',
            'description' => 'Intelligence determines how quickly a character learns new spells and how proficient they are at casting them. Intelligent characters can deal high amounts of magic damage and learn many spells.',
            'user_id' => 1
        ]);

        Stat::insert([
            'created_at' => Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
            'name' => 'Wisdom',
            'description' => 'Wisdom determines how much knowledge a character has gained. Wise characters are more resistance to magic attacks and are more efficient when casting spells.',
            'user_id' => 1
        ]);

        Stat::insert([
            'created_at' => Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
            'name' => 'Charisma',
            'description' => 'Charisma determines how well a character gets along with other people. A charismatic character has better chances convincing others to do things and often gets better deals when bargaining.',
            'user_id' => 1
        ]);
    }
}
