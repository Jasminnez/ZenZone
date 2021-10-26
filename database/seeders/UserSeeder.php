<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    \DB::table('users')->insert([
            ['email' => 'hadis@zendev.se',
            'name' => 'Hadis Durmiš',
            'password' => Hash::make('hadishadis'),
            'username' => 'hadisd'],
            ['email' => 'kenan@zendev.se',
            'name' => 'Kenan Alibegović',
            'password' => Hash::make('kenankenan'),
            'username' => 'kenana'],
           
        ]);
    }
}
