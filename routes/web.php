<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\MainController;
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


Route::get('/', [MainController::class, 'main'])->middleware('auth');

Route::get('/upload', [MainController::class, 'upload'])->middleware('auth');
Route::post('/upload/new', [MainController::class, 'store'])->middleware('auth');

Route::get('/account', [MainController::class, 'account'])->middleware('auth');
Route::post('/account/infos', [MainController::class, 'refreshInfo'])->middleware('auth');
Route::post('/account/networks', [MainController::class, 'refreshNetwork'])->middleware('auth');

Route::get('/song', [MainController::class, 'song'])->middleware('auth');

Route::get("/render/{id}/{file}", [MainController::class, "render"])->middleware('auth')->where("id", "[0-9]+");

Route::get('/likes', [MainController::class, 'likes'])->middleware('auth');

Route::get('/song/{id}', [MainController::class, 'songId'])->where('id','[0-9]+');
Route::post('/song/{id}', [MainController::class, 'addComment'])->where('id','[0-9]+');
Route::get('/deleteComment/{id}', [MainController::class, 'deleteComment'])->where('id','[0-9]+');

Route::get('/playlists', [MainController::class, 'playlists'])->middleware('auth');
Route::get('/playlist/{id}', [MainController::class, 'playlistId'])->where('id','[0-9]+');
Route::get('/addToPlaylist/{idPlaylist}/{idSong}', [MainController::class, 'addToPlaylist'])->middleware('auth')->where('idPlaylist','[0-9]+')->where('idSong','[0-9]+');

Route::get('/user/{id}', [MainController::class, 'userId'])->where('id','[0-9]+');

Route::get('/search/{id}', [MainController::class, "search"]);

Route::get('/changeLike/{id}', [MainController::class, "changeLike"])->middleware('auth')->where('id','[0-9]+');

Auth::routes(['verify' => true]);

