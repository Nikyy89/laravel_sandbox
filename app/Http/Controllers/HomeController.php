<?php

namespace App\Http\Controllers;

use App\Models\System_logs;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $anime_array = [
            [
                'url' => 'https://animem.org/5-toubun-no-hanayome',
                'img' => '1_anime.jpg',
            ],
            [
                'url' => 'https://animem.org/fairy-tail',
                'img' => '2_anime.jpg',
            ],
            [
                'url' => 'https://animem.org/highschool-dxd',
                'img' => '4_anime.jpg',
            ],
            [
                'url' => 'https://animem.org/hagure-yuusha-no-aesthetica',
                'img' => '3_anime.jpg',
            ],
            [
                'url' => 'https://animem.org/maou-sama-retry',
                'img' => 'anime_5.jpg',
            ],
            [
                'url' => 'https://animem.org/mairimashita-iruma-kun',
                'img' => 'anime_6.jpg',
            ],
            [
                'url' => 'https://animem.org/overlord',
                'img' => 'anime_7.jpg',
            ],
            [
                'url' => 'https://animem.org/tensei-shitara-slime-datta-ken',
                'img' => 'anime_8.jpg',
            ],
            [
                'url' => 'https://animem.org/isekai-cheat-magician',
                'img' => 'anime_9.jpg',
            ]
        ];

        // Add log in database
        System_logs::addToLog('web', 'Kezdőlap', 'HomeController', 'View');

        return view('home', ['anime_array' => $anime_array]);
    }
}
