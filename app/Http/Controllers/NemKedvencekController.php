<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use App\Models\System_logs;
use App\Models\UnFavourites;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NemKedvencekController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();

        $nem_kedvencek = $user->unfavourites()->get();

        // Add log in database
        System_logs::addToLog('web', 'Nem kedvencek menüpont felületmegjelenítése', 'NemKedvencekController', 'View');

        return view('nem_kedvencek', compact('nem_kedvencek'));
    }

    public function delete(UnFavourites $unfavourite) {
        $unfavourite->delete();

        // Add log in database
        System_logs::addToLog('web', 'Nem kedvencekből hír törlése', 'NemKedvencekController', 'DeleteUnFavourites');

        return response()->json([
            'success' => true
        ]);
    }

}
