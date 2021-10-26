<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdministratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->insert([
            ['email' => 'senad@zendev.se',
            'name' => 'Senad Šantic',
            'password' => Hash::make('12341234'),
            'username' => 'senads',
            'role_id' => '1',],
            ['email' => 'jasmin@zendev.se',
            'name' => 'Jasmin Nezirić',
            'password' => Hash::make('12341234'),
            'username' => 'jasminn',
            'role_id' => '1'],
           
        ]);
    }
}
