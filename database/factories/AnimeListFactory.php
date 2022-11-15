<?php

namespace Database\Factories;

use App\Models\Anime_list;
use Illuminate\Database\Eloquent\Factories\Factory;

class AnimeListFactory extends Factory
{
    protected $model = Anime_list::class;

    public function definition()
    {
        return [
            'anime_name' => $this->faker->sentence,
            'anime_url' => $this->faker->url,
            'image_path' => $this->faker->image('/img/','140', '200'),
            'created_at' => now(),
            'updated_at' =>now(),
        ];
    }
}
