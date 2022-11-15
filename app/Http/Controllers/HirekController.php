<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use App\Models\System_logs;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Posts;
use App\Models\Like;
use App\Models\Favourites;
use Illuminate\Database\Eloquent\Collection\paginate;
use Illuminate\Support\Facades\Auth;

class HirekController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $search = $request->input('search');
        $page = $request->input('page', 1);
        $itemperpage = $request->input('item', 5);
        $numberofpages = ceil(Posts::all()->count() / $itemperpage);

        $hirek = Posts::query()->when($search ?? false, function($query, $search) {
            $query
                ->where('title', 'like', '%' . $search . '%')
                ->orWhere('content', 'like', '%' . $search . '%');
            })
            ->paginate($itemperpage, $columns = ['*'], $page);

        $user= Auth::user();

        // Add log in database
        System_logs::addToLog('web', 'Hirek menüpont felület megjelenítése', 'HirekController', 'View');

        return view('hirek', compact('hirek', 'numberofpages', 'user'));
    }

    public function addComment(Request $request, $posts_id) {
        $request->validate([
            'comment' => 'required'
        ]);

        $posts = Posts::find($posts_id);

        $posts->comments()->create([
            'user_id' => Auth::user()->id,
            'posts_id' => $posts->id,
            'comment' => $request->get('comment')
        ]);

        return back();

        $user = User::all();

        // Add log in database
        System_logs::addToLog('web', 'Új komment létrehozása', 'HirekController', 'addComment');

        return view('new_comment',compact('user'));
    }

    public function addFavourites($post_id)
    {
        $post = Posts::find($post_id);

        $post->favourites()->create([
            'user_id' => Auth::user()->id,
            'posts_id' => $post->id
        ]);

        // Add log in database
        System_logs::addToLog('web', 'Hír hozzáadása a kedvencekhez', 'HirekController', 'addFavourites');

        return redirect()->route('hirek');
    }

    public function addUnFavourites($post_id)
    {
        $post = Posts::find($post_id);

        $post->unfavourites()->create([
            'user_id' => Auth::user()->id,
            'posts_id' => $post->id
        ]);

        // Add log in database
        System_logs::addToLog('web', 'Hír hozzáadása a nem kedvencekhez', 'HirekController', 'addUnFavourites');

        return redirect()->route('hirek');
    }

    public function addLikes($post_id)
    {
        $post = Posts::find($post_id);

        $post->likes()->create([
            'user_id' => Auth::user()->id,
            'posts_id' => $post->id
        ]);

        // Add log in database
        System_logs::addToLog('web', 'Hír like-olása', 'HirekController', 'addLikes');

        return redirect()->route('hirek');
    }

    public function addDisLikes($post_id)
    {
        $post = Posts::find($post_id);

        $post->dislikes()->create([
            'user_id' => Auth::user()->id,
            'posts_id' => $post->id
        ]);

        // Add log in database
        System_logs::addToLog('web', 'Hír dislike-olása', 'HirekController', 'addDisLikes');

        return redirect()->route('hirek');
    }
}
