<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(ProfessionsTableSeeder::class);
        $this->call(RacesTableSeeder::class);
        $this->call(StatsTableSeeder::class);
        $this->call(CharactersTableSeeder::class);
        $this->call(CharacterStatTableSeeder::class);
    }
}
