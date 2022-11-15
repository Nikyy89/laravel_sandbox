<?php

namespace App\Models;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Posts extends Model
{
    use HasFactory;

    protected $table = 'posts';

    public $timestamps = false;

    protected $fillable = [
        'title', 'content',
    ];

    protected $casts = [
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp',
        'updated_by' => 'integer',
        'created_by' => 'integer',

    ];

    public function scopeFilter($query, array $filters){
        $query->when($filters['search'] ?? false, function($query,$search) {
            $query
                ->where('title', 'like', '%' . $search . '%')
                ->orWhere('content', 'like', '%' . $search . '%');
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function comments()
    {
        return $this->hasMany(Comments::class,'posts_id');
    }

    public function favourites()
    {
        return $this->hasMany(Favourites::class,'posts_id');
    }

    public function likes()
    {
        return $this->hasMany(Like::class,'posts_id');
    }

    public function dislikes()
    {
        return $this->hasMany(DisLike::class,'posts_id');
    }

    public function unfavourites()
    {
        return $this->hasMany(UnFavourites::class,'posts_id');
    }

    protected $withCount = [
        'likes',
        'dislikes',
    ];
}
