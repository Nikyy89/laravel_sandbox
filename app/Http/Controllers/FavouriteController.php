<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use App\Models\System_logs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavouriteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function addFavourites($post_id)
    {
        $post = Posts::find($post_id);

        // Add log in database
        System_logs::addToLog('addFavourites', $post);

        $post->favourites()->create([
            'user_id' => Auth::user()->id,
            'posts_id' => $post->id
        ]);

        return redirect()->route('hirek');
    }
}
