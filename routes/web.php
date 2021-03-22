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

Route::get('/song', [MainController::class, 'song'])->middleware('auth');

Route::get('/song/{id}', [MainController::class, 'songId'])->where('id','[0-9]+');
Route::post('/song/{id}', [MainController::class, 'addComment'])->where('id','[0-9]+');

Route::get('/playlist/{id}', [MainController::class, 'playlistId'])->where('id','[0-9]+');

Route::get('/user/{id}', [MainController::class, 'userId'])->where('id','[0-9]+');

Route::get('/search/{id}', [MainController::class, "search"]);

Route::get('/changeLike/{id}', [MainController::class, "changeLike"]);

Auth::routes(['verify' => true]);

