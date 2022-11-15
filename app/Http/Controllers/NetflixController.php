<?php

namespace App\Http\Controllers;

use App\Models\Anime_list;
use App\Models\System_logs;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection\paginate;

class NetflixController extends Controller
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
        $numberofpages = ceil(Netflix::all()->count() / $itemperpage);

        $netflix = Netflix::query()->when($search ?? false, function($query, $search) {
            $query->where('anime_name', 'like', $search . '%');
        })
            ->paginate($itemperpage, $columns = ['*'], $page);

        if($src !== null)
        {
            $netflix = Netflix::query()
                ->where('anime_name', 'like', $src .'%')
                ->paginate($itemperpage, $columns = ['*'], $page);
        }
    }
}
