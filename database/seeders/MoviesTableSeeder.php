<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MoviesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('movies')->insert([
            ['title' => 'Inception', 'is_published' => false, 'poster_url' => 'inception.jpg'],
            ['title' => 'The Matrix', 'is_published' => false, 'poster_url' => 'matrix.jpg'],
            ['title' => 'Joker', 'is_published' => false, 'poster_url' => 'joker.jpg'],
            ['title' => 'Interstellar', 'is_published' => false, 'poster_url' => 'interstellar.jpg'],
            ['title' => 'Parasite', 'is_published' => false, 'poster_url' => 'parasite.jpg'],
        ]);
    }
}
