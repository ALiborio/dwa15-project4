<?php

use Illuminate\Database\Seeder;
use GameMaster\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::firstOrCreate([
            'email' => 'admin@adamliborio.com',
            'name' => 'Admin User',
            'password' => Hash::make('admin')
        ]);
    }
}
