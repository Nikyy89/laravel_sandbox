<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UnFavouriteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function addUnFavourites($post_id)
    {

        $post = Posts::find($post_id);

        $post->unfavourites()->create([
            'user_id' => Auth::user()->id,
            'posts_id' => $post->id
        ]);

        return redirect()->route('hirek');
    }
}
