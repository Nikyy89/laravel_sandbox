<?php

namespace App\Http\Controllers;
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Models\System_logs;

class LogoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $auth = auth()->logout();

        // Add log in database
        //System_logs::addToLog('Logout', $auth, 'LogoutController', 'Logout');

        return redirect('/')->with('success', 'Goodbye!');
    }
}
