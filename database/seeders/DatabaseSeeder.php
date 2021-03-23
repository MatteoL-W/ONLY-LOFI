<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        DB::table("users")->insert([
            'name' => "Styrau",
            'email' => "monokiba@hotmail.fr",
            'password' => bcrypt("317e0dcc"),
            'avatar' => "fakeavatar",
            'birthday' => "2001-02-07",
        ]);

        DB::table('song')->insert([
            'title' => 'chanson un',
            'url' => 'https://www.dropbox.com/s/lhwia07riwm9pms/old-songs-but-its-lofi-remix.mp3?dl=0',
            'user_id' => 1,
        ]);
        
    }
}
