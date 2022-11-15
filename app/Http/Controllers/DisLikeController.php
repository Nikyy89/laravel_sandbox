<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use App\Models\DisLike;
use App\Models\Like;
use App\Models\Posts;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DisLikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function addDisLikes($post_id)
    {

        $post = Posts::find($post_id);

        $post->dislikes()->create([
            'user_id' => Auth::user()->id,
            'posts_id' => $post->id
        ]);

        return back();

        return redirect()->route('hirek');
    }
}
