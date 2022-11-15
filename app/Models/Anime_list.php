<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anime_list extends Model
{
    use HasFactory;

    protected $table = 'anime_list';

    protected $fillable = [
        'anime_name', 'anime_url', 'image_path'
    ];

    protected $casts = [
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp',
    ];
}
