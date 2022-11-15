<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DisLike extends Model
{
    use HasFactory;

    protected $table = 'dislike';

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
        return $this->belongsTo(User::class);
    }

    public function posts()
    {
        return $this->belongsTo(Posts::class);
    }

    /*
        public Post $post;
        public int $count;

        public function mount(Post $post)
        {
            $this->post = $post;
            $this->count = $post->likes_count;
        }

        public function like(): void
        {
            if ($this->post->isLiked()) {
                $this->post->removeLike();

                $this->count--;
            } elseif (auth()->user()) {
                $this->post->likes()->create([
                    'user_id' => auth()->id(),
                ]);

                $this->count++;
            }
        }

        public function isLiked(): bool
        {
            if (auth()->user()) {
                return auth()->user()->likes()->forPost($this)->count();
            }

            return false;
        }

        public function removeLike(): bool
        {
            if (auth()->user()) {
                return auth()->user()->likes()->forPost($this)->delete();
            }

            return false;
        }

        public function scopeForPost($query, Post $post)
        {
            return $query->where('posts_id', $post->id);
        }
    */
}


