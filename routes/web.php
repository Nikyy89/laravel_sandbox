<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HirekController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\LogsController;
use App\Http\Controllers\KedvencekController;
use App\Http\Controllers\NemKedvencekController;
use App\Http\Controllers\Auth\ProfilomController;
use App\Http\Controllers\StatisticsController;
use App\Http\Controllers\NetflixController;


Route::get('/', [App\Http\Controllers\WelcomeController::class, 'index']);

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/anime_lists/{src?}', [App\Http\Controllers\AnimeListController::class, 'index'])->name('anime_lists');

    Route::controller(KedvencekController::class)->group(function(){
        Route::delete('/kedvencek/{favourite}/delete','delete')->name('kedvencek.delete');
        Route::get('/kedvencek', 'index')->name('kedvencek');
    });

    Route::controller(NemKedvencekController::class)->group(function(){
        Route::get('/nem_kedvencek', 'index')->name('nem_kedvencek');
        Route::delete('/nem_kedvencek/{unfavourite}/delete', 'delete')->name('nem_kedvencek.delete');
    });

    Route::controller(HirekController::class)->group(function(){
        Route::post('/hirek/comment/{posts_id}', 'addComment')->name('hirek.comment');
        Route::post('/hirek/like/{post_id}', 'addLikes')->name('hirek.like');
        Route::post('/hirek/dislike/{post_id}', 'addDisLikes')->name('hirek.dislike');
        Route::post('/hirek/favourite/{post_id}', 'addFavourites')->name('hirek.favourites');
        Route::post('/hirek/unfavourite/{post_id}', 'addUnFavourites')->name('hirek.unfavourites');
        Route::get('/hirek', 'index')->name('hirek');
    });

    Route::controller(ProfilomController::class)->group(function(){
        Route::get('/profilom','index')->name('profilom');
        Route::post('/profilom/update','update')->name('profilom.update');
        Route::post('/profilom/image','upload')->name('profilom.image');
    });

    Route::controller(LogsController::class)->group(function(){
        Route::get('/logs', 'index')->name('logs');
        Route::get('/logs/{id}/show', 'show')->name('logs.show');
    });

    Route::controller(StatisticsController::class)->group(function(){
        Route::get('/statistics', 'index')->name('statistics');
    });

    Route::controller(NetflixController::class)->group(function(){
        Route::get('/netflix', 'index')->name('netflix');
    });

    Route::controller(WhatWatchController::class)->group(function(){
        Route::get('/what_watch', 'index')->name('what_watch');
    });

    Route::post('/logout', [App\Http\Controllers\Auth\LogoutController::class, 'index'])->name('logout');
});

//ADMIN
Route::controller(AdminPostController::class)->group(function(){
    Route::get('/admin/hirek/index/{post?}', 'index')->name('admin.hirek.index');
    Route::get('/admin/hirek/show', 'view_new_post')->name('admin.hirek.show');
    Route::post('/admin/hirek/create', 'create_new_post')->name('admin.hirek.create');
    Route::put('/admin/hirek/edit/{post}', 'edit')->name('admin.hirek.edit');
    Route::delete('/admin/hirek/{post}/delete', 'delete')->name('admin.hirek.delete');
});
//Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'index'])->name('login');

