<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\MakeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\CityController;
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

Route::post('/token', [UserController::class, 'token']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/makes', [MakeController::class, 'index']);
Route::get('/countries', [CountryController::class, 'index']);
Route::get('/cities/{country}', [CityController::class, 'index']);

Route::get('modeles/{make}', [ModeleController::class, 'index']);
Route::prefix('cars')->group(function(){
    Route::get('/calculate', [CarController::class, 'calculate']);
    Route::get('/{car}', [CarController::class, 'show']);
    Route::middleware('auth:sanctum')->post('/', [CarController::class, 'store']);
    Route::get('/', [CarController::class, 'index']);
});
