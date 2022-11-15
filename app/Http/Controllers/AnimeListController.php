<?php

namespace App\Http\Controllers;

use App\Models\Anime_list;
use App\Models\Posts;
use App\Models\System_logs;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection\paginate;

class AnimeListController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request, $src = null)
    {
        $search = $request->input('search');
        $page = $request->input('page', 1);
        $itemperpage = $request->input('item', 12);
        $numberofpages = ceil(Anime_list::all()->count() / $itemperpage);

        $anime_lists = Anime_list::query()->when($search ?? false, function($query, $search) {
            $query->where('anime_name', 'like', $search . '%');
        })
            ->paginate($itemperpage, $columns = ['*'], $page);

        if($src !== null)
        {
            $anime_lists = Anime_list::query()
                ->where('anime_name', 'like', $src .'%')
                ->paginate($itemperpage, $columns = ['*'], $page);
        }

        $anime_alphabetical_array = [
            'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S',
            'T', 'W', 'V', 'X', 'Y', 'Z', '1'
        ];

        // Add log in database
        System_logs::addToLog('web', 'Anime listák megjelenítése', 'AnimeListController', 'Vire');

        return view('anime_lists', ['anime_alphabetical_array' => $anime_alphabetical_array],
            compact('anime_lists') );
    }
}
