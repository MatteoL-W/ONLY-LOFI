<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MainController;

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

Route::get('/inscription', [MainController::class, 'inscription']);

Route::get('/', [MainController::class, 'main']);

Route::get('/upload', [MainController::class, 'upload']);

Route::get('/song', [MainController::class, 'song']);
