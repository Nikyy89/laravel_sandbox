<?php

namespace Database\Seeders;

use App\Models\Anime_list;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Comments;
use App\Models\Favourites;
use App\Models\Like;
use App\Models\Posts;
use Illuminate\Database\Console\Factories\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $users = User::factory(10)->create();

        foreach($users as $user){
            $post = Posts::factory(rand(1,25))->create(['user_id' => $user['id']]);
            $like = Like::factory(rand(1,25))->create(['user_id' => $user['id']]);
            $favourite = Favourites::factory(rand(1,25))->create(['user_id' => $user['id']]);
            $comment = Comments::factory(rand(1,25))->create(['user_id' => $user['id']]);

            //$updated_by = create(['user_id' => $user['id']]);
            //$created_by = create(['user_id' => $user['id']]);
        }

        Anime_list::truncate();

        $csvFile = fopen(base_path("database/data/anime_lista.csv"), "r");

        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ";")) !== FALSE) {
            if (!$firstline) {
                Anime_list::create([
                    "anime_name" => $data['0'],
                    "anime_url" => $data['1'],
                    "image_path" => $data['2'],
                    "created_at" => Carbon::rawCreateFromFormat('Y-m-d', $data['3'], 'Europe/Stockholm'),
                    "updated_at" => Carbon::rawCreateFromFormat('Y-m-d', $data['4'], 'Europe/Stockholm')
                ]);
            }
            $firstline = false;
        }

        fclose($csvFile);
    }
}
