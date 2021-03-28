<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ChangeController;
use App\Http\Controllers\SongPlaylistController;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* MAIN CONTROLLER */

Route::get('/', [MainController::class, 'main'])->middleware('auth');
Route::get('/upload', [MainController::class, 'upload'])->middleware('auth');
Route::get('/account', [MainController::class, 'account'])->middleware('auth');
Route::get('/song', [MainController::class, 'song'])->middleware('auth');
Route::get('/likes', [MainController::class, 'likes'])->middleware('auth');

Route::get('/song/{id}', [MainController::class, 'songId'])->where('id','[0-9]+');
Route::post('/song/{id}', [MainController::class, 'addComment'])->where('id','[0-9]+');
Route::get('/deleteComment/{id}', [MainController::class, 'deleteComment'])->middleware('auth')->where('id','[0-9]+');

Route::get('/allSongs', [MainController::class, 'yourSongs'])->middleware('auth');

Route::get('/playlists', [MainController::class, 'playlists'])->middleware('auth');
Route::get('/playlist/{id}', [MainController::class, 'playlistId'])->where('id','[0-9]+');

Route::get('/user/{id}', [MainController::class, 'userId'])->where('id','[0-9]+');

Route::get('/search/{id}', [MainController::class, "search"]);
Route::get('/search', [MainController::class, "main"]);

Route::get('/addListenedSong/{idListened}', [MainController::class, "addListenedSong"])->middleware('auth')->where('idListener','[0-9]+')->where('idListened','[0-9]+');
Route::get('/addListenedPlaylist/{idListened}', [MainController::class, "addListenedPlaylist"])->middleware('auth')->where('idListener','[0-9]+')->where('idListened','[0-9]+');


/* ADD SONG / PLAYLIST CONTROLLER */

Route::post('/upload/new', [SongPlaylistController::class, 'store'])->middleware('auth');

Route::get("/render/{id}/{file}", [SongPlaylistController::class, "render"])->middleware('auth')->where("id", "[0-9]+");

Route::get('/createPlaylist', [SongPlaylistController::class, 'createPlaylist'])->middleware('auth');
Route::post('/createPlaylist', [SongPlaylistController::class, 'TcreatePlaylist'])->middleware('auth');

Route::get('/addToPlaylist/{idPlaylist}/{idSong}', [SongPlaylistController::class, 'addToPlaylist'])->middleware('auth')->where('idPlaylist','[0-9]+')->where('idSong','[0-9]+');


/* CHANGE INFO CONTROLLER */

Route::post('/account/infos', [ChangeController::class, 'refreshInfo'])->middleware('auth');
Route::post('/account/networks', [ChangeController::class, 'refreshNetwork'])->middleware('auth');

Route::get('/modifImage/{type}/{id}', [ChangeController::class, "modifImage"])->middleware('auth')->where('id','[0-9]+');
Route::post('/modifImage/{type}/{id}', [ChangeController::class, "TmodifImage"])->middleware('auth')->where('id','[0-9]+');

Route::get('/delete/{type}/{id}', [ChangeController::class, "delete"])->middleware('auth')->where('id','[0-9]+');

Route::get('/deleteFromPlaylist/{idPlaylist}/{idSong}', [ChangeController::class, "deleteFromPlaylist"])->middleware('auth')->where('idPlaylist','[0-9]+')->where('idSong','[0-9]+');

Route::get('/changeLike/{id}', [ChangeController::class, "changeLike"])->middleware('auth')->where('id','[0-9]+');

Auth::routes(['verify' => true]);