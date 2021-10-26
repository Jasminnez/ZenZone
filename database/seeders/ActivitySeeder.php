<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('activities')->insert([
            ['name' => 'Playing Basketball',
            'description' => 'Basketball is a team sport in which two teams, most commonly of five players each, opposing one another on a rectangular court, compete.',
            'date' => now(),
            'category_id' => '1',
            'is_challenge' => '0'],
            ['name' => 'Atending PHP Course',
            'description' => 'Master your language with lessons, quizzes, and projects designed for real-life scenarios. Create portfolio projects that showcase your new skills to help land your dream job.',
            'date' => now(),
            'category_id' => '4',
            'is_challenge' => '0'],
            ['name' => 'Painting',
            'description' => 'In art, the term painting describes both the act of painting, (using either a brush or other implement, such as palette knife, sponge, or airbrush to apply the paint); and the result of the action – the painting as an object.',
            'date' => now(),
            'category_id' => '3',
            'is_challenge' => '0'],
        ]);
    }
}
