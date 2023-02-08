<?php

use App\Http\Controllers\GenerationTreeController;
use App\Models\GenerationTree;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'tree'], function () {
    Route::get('', [GenerationTreeController::class, 'getAllNode'])->name('get-all-node');
    Route::put('{id}', [GenerationTreeController::class, 'update']);
    Route::delete('{id}', [GenerationTreeController::class, 'delete']);
    Route::group(['prefix' => 'root'], function () {
        Route::post('/create', [GenerationTreeController::class, 'createNewRoot']);
    });
    Route::group(['prefix' => 'descendant'], function () {
        Route::post('/create', [GenerationTreeController::class, 'createDescendant']);
        Route::get('/{id}/descendant', [GenerationTreeController::class, 'getDescendant']);
    });
});
