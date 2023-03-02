<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PostController;

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

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix' => 'post'], function () {
    Route::get('/list', [PostController::class, 'index']);
    Route::get('/show/{post}', [PostController::class, 'show']);
    Route::post('/store', [PostController::class, 'store'])->middleware(['auth:sanctum']);
    Route::post('/updateTile/{post}', [PostController::class, 'updateTile'])->middleware(['auth:sanctum']);
    Route::post('/updateContent/{post}', [PostController::class, 'updateContent'])->middleware(['auth:sanctum']);
    Route::post('/destroy/{post}', [PostController::class, 'destroy'])->middleware(['auth:sanctum']);
});
