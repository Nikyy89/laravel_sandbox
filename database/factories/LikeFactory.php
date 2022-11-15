<?php

namespace Database\Factories;

use App\Models\Like;
use App\Models\Posts;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class LikeFactory extends Factory
{
protected $model = Like::class;

public function definition()
    {
        return [
            'user_id' => User::factory(),
            'posts_id' => Posts::factory(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
