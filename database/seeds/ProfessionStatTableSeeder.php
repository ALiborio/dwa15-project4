<?php

use Illuminate\Database\Seeder;
use GameMaster\Profession;
use GameMaster\Stat;

class ProfessionStatTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $professions = [
            'barbarian' => ['strength','dexterity'],
            'bard' => ['charisma','wisdom'],
            'cleric' => ['wisdom','charisma'],
            'druid' => ['wisdom','dexterity'],
            'fighter' => ['strength','constitution'],
            'paladin' => ['constitution','wisdom'],
            'ranger' => ['dexterity','constitution'],
            'rogue' => ['dexterity','charisma'],
            'sorcerer' => ['wisdom','intelligence'],
            'wizard' => ['intelligence','wisdom']
        ];
        foreach ($professions as $name => $attributes) {
            $profession = Profession::where('name', 'LIKE', $name)->first();
            $primaryStat = Stat::where('name', 'LIKE', $attributes[0])->first();
            $secondaryStat = Stat::where('name', 'LIKE', $attributes[1])->first();
            $profession->stats()->sync([
                $primaryStat->id => ['ranking' => 'primary'],
                $secondaryStat->id => ['ranking' => 'secondary']
            ]);
        }
    }
}
