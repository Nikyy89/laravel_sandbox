<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Posts;
use Illuminate\Support\Str;

class PostsFactory extends Factory
{
    protected $model = Posts::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraph(3),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
