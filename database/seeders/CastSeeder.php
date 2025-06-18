<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Symfony\Component\HttpKernel\Profiler\Profile;
use Illuminate\Support\Facades\DB;

class CastSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['realname'=>'Paul Mescal','moviename'=>'Lucius', 'profile_url'=>'https://media.themoviedb.org/t/p/w138_and_h175_face/vrzZ41TGNAFgfmZjC2sOJySzBLd.jpg' ],
            ['realname'=>'Denzel Washington','moviename'=>'Macrinus', 'profile_url'=>'https://media.themoviedb.org/t/p/w138_and_h175_face/9Iyt3wbsla5bM6IzbICDVnBhkER.jpg' ],
            ['realname'=>'Connie Nielsen','moviename'=>'Lucilla', 'profile_url'=>'https://media.themoviedb.org/t/p/w138_and_h175_face/lvQypTfeH2Gn2PTbzq6XkT2PLmn.jpg' ],
            ['realname'=>'Pedro Pascal','moviename'=>'General Acacius', 'profile_url'=>'https://media.themoviedb.org/t/p/w138_and_h175_face/9VYK7oxcqhjd5LAH6ZFJ3XzOlID.jpg' ],
            ['realname'=>'Joseph Quinn','moviename'=>'Emperor Geta', 'profile_url'=>'https://media.themoviedb.org/t/p/w138_and_h175_face/zshhuioZaH8S5ZKdMcojzWi1ntl.jpg' ],
            ['realname'=>'Fred Hechinger','moviename'=>'Emperor Caracalla', 'profile_url'=>'https://media.themoviedb.org/t/p/w138_and_h175_face/dLFy4KFR556j4Z9WstsslhJCwyZ.jpg' ],
        ];
        foreach($data as $cast){
            DB::table('cast')->insert([
                'realname'=>$cast['realname'],
                'moviename'=>$cast['moviename'],
                'profile_url'=>$cast['profile_url'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
