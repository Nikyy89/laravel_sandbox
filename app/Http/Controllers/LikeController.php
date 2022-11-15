<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use App\Models\Like;
use App\Models\Posts;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function addLikes($post_id)
    {

        $post = Posts::find($post_id);

        $post->likes()->create([
            'user_id' => Auth::user()->id,
            'posts_id' => $post->id
        ]);

        return back();

        return redirect()->route('hirek');
    }
}
