<?php

namespace App\Http\Controllers;

use App\Models\Favourites;
use App\Models\System_logs;
use App\Models\UnFavourites;
use App\Models\Posts;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KedvencekController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();

        $kedvencek = $user->favourites()->get();

        // Add log in database
        System_logs::addToLog('web', 'Kedvencek menüpont felület megjelenítése', 'KedvencekController', 'View');

        return view('kedvencek', compact('kedvencek'));
    }

    public function delete(Favourites $favourite) {
        $favourite->delete();

        // Add log in database
        System_logs::addToLog('web', 'Kedvencekből hír törlése', 'KedvencekController', 'DeleteFavourites');

        return response()->json([
            'success' => true
        ]);
    }

}
