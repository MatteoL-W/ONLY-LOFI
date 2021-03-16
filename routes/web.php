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


//Route::post('/inscription', [MainController::class, 'Tinscription']);

Route::get('/', [MainController::class, 'main'])->middleware('auth');

Route::get('/upload', [MainController::class, 'upload'])->middleware('auth');

Route::get('/song', [MainController::class, 'song'])->middleware('auth');

Auth::routes();

