<?php

namespace App\Http\Controllers;

use App\Enum\LogLevel;
use App\Models\Roles;
use App\Models\System_logs;
use App\Http\Controllers\Logger;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection\paginate;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StatisticsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $statistics = System_logs::all();
        $user = Auth::user();
        $to = now()->endOfDay();
        $from = now()->addMonth(-1)->startOfDay();

        $statistics_login = System_logs::query()->
            select([DB::raw('DATE(`created_at`) date'), DB::raw('count(*) count')])->
            where('controller', '=', 'LoginController')->
            whereBetween('created_at', [$from, $to])->
            groupBy('date')->
            orderBy('date')->
            get(['date', 'count'])->
            toArray();

        $stat_login_x = [];
        $stat_login_y = [];
        foreach ($statistics_login as $item){
            $stat_login_x[] = $item['date'];
            $stat_login_y[] = $item['count'];
        }

        $statistics_visitor = System_logs::query()->
        select([DB::raw('DATE(`created_at`) date'), DB::raw('count(*) count')])->
        where('controller', '=', 'WelcomeController')->
        whereBetween('created_at', [$from, $to])->
        groupBy('date')->
        orderBy('date')->
        get(['date', 'count'])->
        toArray();

        $stat_visitor_x = [];
        $stat_visitor_y = [];
        foreach ($statistics_visitor as $item){
            $stat_visitor_x[] = $item['date'];
            $stat_visitor_y[] = $item['count'];
        }

        $statistics_Likes = System_logs::query()->
        select([DB::raw('DATE(`created_at`) date'), DB::raw('count(*) count')])->
        where('controller', '=', 'HirekController')->
        where('method', '=', 'addLikes')->
        whereBetween('created_at', [$from, $to])->
        groupBy('date')->
        orderBy('date')->
        get(['date', 'count'])->
        toArray();

        $stat_Likes_x = [];
        $stat_Likes_y = [];
        foreach ($statistics_Likes as $item){
            $stat_Likes_x[] = $item['date'];
            $stat_Likes_y[] = $item['count'];
        }

        $statistics_DisLikes = System_logs::query()->
        select([DB::raw('DATE(`created_at`) date'), DB::raw('count(*) count')])->
        where('controller', '=', 'HirekController')->
        where('method', '=', 'addDisLikes')->
        whereBetween('created_at', [$from, $to])->
        groupBy('date')->
        orderBy('date')->
        get(['date', 'count'])->
        toArray();

        $stat_DisLikes_x = [];
        $stat_DisLikes_y = [];
        foreach ($statistics_DisLikes as $item){
            $stat_DisLikes_x[] = $item['date'];
            $stat_DisLikes_y[] = $item['count'];;
        }

        $statistics_Favourites = System_logs::query()->
        select([DB::raw('DATE(`created_at`) date'), DB::raw('count(*) count')])->
        where('controller', '=', 'HirekController')->
        where('method', '=', 'addFavourites')->
        whereBetween('created_at', [$from, $to])->
        groupBy('date')->
        orderBy('date')->
        get(['date', 'count'])->
        toArray();

        $stat_Favourites_x = [];
        $stat_Favourites_y = [];
        foreach ($statistics_Favourites as $item){
            $stat_Favourites_x[] = $item['date'];
            $stat_Favourites_y[] = $item['count'];
        }

        $statistics_UnFavourites = System_logs::query()->
        select([DB::raw('DATE(`created_at`) date'), DB::raw('count(*) count')])->
        where('controller', '=', 'HirekController')->
        where('method', '=', 'addUnFavourites')->
        whereBetween('created_at', [$from, $to])->
        groupBy('date')->
        orderBy('date')->
        get(['date', 'count'])->
        toArray();

        $stat_UnFavourites_x = [];
        $stat_UnFavourites_y = [];
        foreach ($statistics_UnFavourites as $item){
            $stat_UnFavourites_x[] = $item['date'];
            $stat_UnFavourites_y[] = $item['count'];
        }
        return view('statistics',
               compact('statistics', 'user', 'stat_login_x', 'stat_login_y', 'stat_visitor_x', 'stat_visitor_y',
               'stat_Likes_x', 'stat_Likes_y', 'stat_DisLikes_x', 'stat_DisLikes_y', 'stat_Favourites_x', 'stat_Favourites_y',
               'stat_UnFavourites_x', 'stat_UnFavourites_y'));
    }
}
