<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MovieGenreTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('genre_movie')->insert([
            ['movie_id' => 1, 'genre_id' => 5],
            ['movie_id' => 2, 'genre_id' => 5],
            ['movie_id' => 3, 'genre_id' => 3],
            ['movie_id' => 4, 'genre_id' => 5],
            ['movie_id' => 5, 'genre_id' => 3],
            ['movie_id' => 5, 'genre_id' => 2],
        ]);
    }
}
