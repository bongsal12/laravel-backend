<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

use App\Models\Movie;
use App\Models\Genre;

class MoviesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('movie_genre')->delete();
        DB::table('movie')->delete();

        $movies = [
            [
                'title' => 'Sinners',
                'overview' => 'Trying to leave their troubled lives behind, twin brothers return to their hometown to start again, only to discover that an even greater evil is waiting to welcome them back.',
                'release_date' => '2025-04-18',
                'rating' => 7.5,
                'runtime' => '2h 18mn',
                'is_movie' => true,
                'thumbnail_url' => 'https://image.tmdb.org/t/p/original/fWPgbnt2LSqkQ6cdQc0SZN9CpLm.jpg',
                'bg_url' => 'https://image.tmdb.org/t/p/w1280//nAxGnGHOsfzufThz20zgmRwKur3.jpg',
                'director' => 'Ryan Coogler',
                'writer' => 'Ryan Coogler',

                'genres' => ['Horror', 'Thriller']
            ],
            [
                'title' => 'Home Sweet Home: Rebirth',
                'overview' => 'When a city is overrun with a demonically-possessed crowd, a cop must find the source of evil to save his family.',
                'release_date' => '2025-03-20',
                'rating' => 6.8,
                'runtime' => '1h 33mn',
                'is_movie' => true,
                'thumbnail_url' => 'https://image.tmdb.org/t/p/original/9rCBCm9cyI4JfLEhx3EncyncMR3.jpg',
                'bg_url' => 'https://image.tmdb.org/t/p/w1280//wmqpE7p2dUCEgCnovuovoNXaCXr.jpg',
                'director' => 'Alexander Kiesl, Steffen Hacker',
                'writer' => 'n/a',

                'genres' => ['Horror', 'Thriller']
            ],
            [
                'title' => 'Sinners',
                'overview' => 'Trying to leave their troubled lives behind, twin brothers return to their hometown to start again, only to discover that an even greater evil is waiting to welcome them back.',
                'release_date' => '2025-04-18',
                'rating' => 7.5,
                'runtime' => '2h 18mn',
                'is_movie' => true,
                'thumbnail_url' => 'https://image.tmdb.org/t/p/original/fWPgbnt2LSqkQ6cdQc0SZN9CpLm.jpg',
                'bg_url' => 'https://image.tmdb.org/t/p/w1280//nAxGnGHOsfzufThz20zgmRwKur3.jpg',
                'director' => 'Ryan Coogler',
                'writer' => 'Ryan Coogler',

                'genres' => ['Horror', 'Thriller']
            ],
            [
                'title' => 'Home Sweet Home: Rebirth',
                'overview' => 'When a city is overrun with a demonically-possessed crowd, a cop must find the source of evil to save his family.',
                'release_date' => '2025-03-20',
                'rating' => 6.8,
                'runtime' => '1h 33mn',
                'is_movie' => true,
                'thumbnail_url' => 'https://image.tmdb.org/t/p/original/9rCBCm9cyI4JfLEhx3EncyncMR3.jpg',
                'bg_url' => 'https://image.tmdb.org/t/p/w1280//wmqpE7p2dUCEgCnovuovoNXaCXr.jpg',
                'director' => 'Alexander Kiesl, Steffen Hacker',
                'writer' => 'n/a',

                'genres' => ['History', 'Horror', 'Thriller']
            ],
            [
                'title' => 'Sinners kk',
                'overview' => ' return to their hometown to start again, only to discover that an even greater evil is waiting to welcome them back.',
                'release_date' => '2025-04-18',
                'rating' => 7.5,
                'runtime' => '2h 18mn',
                'is_movie' => true,
                'thumbnail_url' => 'https://image.tmdb.org/t/p/original/fWPgbnt2LSqkQ6cdQc0SZN9CpLm.jpg',
                'bg_url' => 'https://image.tmdb.org/t/p/w1280//nAxGnGHOsfzufThz20zgmRwKur3.jpg',
                'director' => 'Ryan Coogler',
                'writer' => 'Ryan Coogler',
                'created_at' => now(),
                'updated_at' => now(),
                'genres' => ['Family', 'Thriller', 'Western']
            ],
            [
                'title' => ' Home: Rebirth',
                'overview' => 'possessed crowd, a cop must find the source of evil to save his family.',
                'release_date' => '2025-03-20',
                'rating' => 6.8,
                'runtime' => '1h 33mn',
                'is_movie' => true,
                'thumbnail_url' => 'https://image.tmdb.org/t/p/original/9rCBCm9cyI4JfLEhx3EncyncMR3.jpg',
                'bg_url' => 'https://image.tmdb.org/t/p/w1280//wmqpE7p2dUCEgCnovuovoNXaCXr.jpg',
                'director' => 'Alexander Kiesl, Steffen Hacker',
                'writer' => 'n/a',

                'genres' => ['Crime', 'Romance']
            ],
        ];

        foreach ($movies as $movieData) {
            $movie = Movie::create([
                'title' => $movieData['title'],
                'overview' => $movieData['overview'],
                'release_date' => $movieData['release_date'],
                'slug' => Str::slug($movieData['title']),
                'rating' => $movieData['rating'],
                'runtime' => $movieData['runtime'],
                'is_movie' => $movieData['is_movie'],
                'thumbnail_url' => $movieData['thumbnail_url'],
                'bg_url' => $movieData['bg_url'],
                "vdo_url" => "https://vidsrc.xyz/embed/movie/tt21191806",
                'director' => $movieData['director'],
                'writer' => $movieData['writer'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $genres = Genre::whereIn('name', $movieData['genres'])->pluck('id');
            $movie->genre()->attach($genres);

        }
    }
}
