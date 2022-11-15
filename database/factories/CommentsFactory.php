<?php

namespace Database\Factories;

use App\Models\Comments;
use App\Models\Posts;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CommentsFactory extends Factory
{
    protected $model = Comments::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'posts_id' => Posts::factory(),
            'comment' => $this->faker->paragraph,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
