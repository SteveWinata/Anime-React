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
Route::prefix('animes')->group(function(){
    Route::get('/', [AnimeController::class, 'index']);
    Route::post('/', [AnimeController::class, 'store']);
    
    Route::delete('/{anime}', [AnimeController::class, 'destroy']);
    
    Route::put('/{anime:id}/edit', [AnimeController::class, 'update']);
    
    Route::get('/{slug}', [AnimeController::class, 'show']);
    Route::post('/checkSlug', [AnimeController::class, 'createSlug']);
});

