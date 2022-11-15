<?php

namespace App\Http\Controllers;

use App\Enum\LogLevel;
use App\Models\Roles;
use App\Models\System_logs;
use App\Http\Controllers\Logger;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection\paginate;
use Illuminate\Support\Facades\Auth;

class LogsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $search = $request->input('search');
        $page = $request->input('page', 1);
        $itemperpage = $request->input('item', 12);
        $numberofpages = ceil(System_logs::all()->count() / $itemperpage);

        $logs = System_logs::query()->when($search ?? false, function($query, $search) {
            $query
                ->where('created_at', 'like', $search . '%')
                ->orWhere('log_level', 'like', '%' . $search . '%')
                ->orWhere('user_id', 'like', '%' . $search . '%')
                ->orWhere('controller', 'like', '%' . $search . '%')
                ->orWhere('method', 'like', '%' . $search . '%');
        })
            ->paginate($itemperpage, $columns = ['*'], $page);

        $user= Auth::user();

        // Add log in database
        System_logs::addToLog('web', 'Log menüpont felület megjelenítése', 'LogsController', 'Logs');

        return view('logs', compact('logs', 'numberofpages', 'user'));
    }

    public function show($id){
        $logs = System_logs::find($id);

        // Add log in database
        System_logs::addToLog('web', 'Log bemutatása', 'LogsController', 'LogsShow');

        return view('logs_show', compact('logs'));
    }
}
