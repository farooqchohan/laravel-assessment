<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BoxController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/boxes', [BoxController::class, 'index']);
Route::post('/boxes/shuffle', [BoxController::class, 'shuffleColors']);
Route::post('/boxes/sort', [BoxController::class, 'sortBoxes']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
