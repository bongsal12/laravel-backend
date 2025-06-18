<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class GenresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $genres = [
            'Action',
            'Adventure',
            'Animation',
            'Biography',
            'Comedy',
            'Crime',
            'Documentary',
            'Drama',
            'Family',
            'Fantasy',
            'History',
            'Horror',
            'Music',
            'Mystery',
            'Reality',
            'Romance',
            'Science Fiction',
            'Talk',
            'Thriller',
            'TV Movie',
            'War',
            'Western'
        ];
        foreach ($genres as $genre) {
            DB::table('genre')->insert([
                'name'=>$genre,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
