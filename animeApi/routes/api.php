<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnimeController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/animes', [AnimeController::class, 'index']);
Route::post('/animes', [AnimeController::class, 'store']);

Route::delete('/anime/{id}', [AnimeController::class, 'destroy']);

Route::put('/anime/{slug}/edit', [AnimeController::class, 'update']);

Route::get('/anime/{slug}', [AnimeController::class, 'show']);
Route::post('/anime/checkSlug', [AnimeController::class, 'createSlug']);
