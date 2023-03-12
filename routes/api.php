<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataController;
use App\Http\Controllers\RestTemplateDataController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MerekController;
use App\Http\Controllers\ProdukController;

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

Route::group(['prefix' => 'merek'], function () {
    Route::get('/get', [MerekController::class, 'get']);
    Route::post('/create', [MerekController::class, 'create']);
    Route::get('/detail/{id}', [MerekController::class, 'detail']);
    Route::post('/update/{id}', [MerekController::class, 'update']);
    Route::get('/delete/{id}', [MerekController::class, 'delete']);
});

Route::group(['prefix' => 'produk'], function () {
    Route::get('/get', [ProdukController::class, 'get']);
    Route::post('/create', [ProdukController::class, 'create']);
    Route::get('/detail/{id}', [ProdukController::class, 'detail']);
    Route::post('/update/{id}', [ProdukController::class, 'update']);
    Route::get('/delete/{id}', [ProdukController::class, 'delete']);
});

