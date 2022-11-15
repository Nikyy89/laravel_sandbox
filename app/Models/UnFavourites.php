<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnFavourites extends Model
{
    use HasFactory;

    protected $table = 'unfavourites';

    protected $fillable = [
    ];

    protected $casts = [
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp',
        'updated_by' => 'integer',
        'created_by' => 'integer',

    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function posts()
    {
        return $this->belongsTo(Posts::class,'posts_id');
    }
}
