<?php

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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::get('surveys', [\App\Http\Controllers\SurveyController::class, 'index']);
Route::get('surveys/name', [\App\Http\Controllers\SurveyController::class, 'show']);
Route::post('surveys', [\App\Http\Controllers\SurveyController::class, 'store']);
Route::post('surveys1', [\App\Http\Controllers\SurveyController::class, 'store']);
Route::post('surveys/info', [\App\Http\Controllers\SurveyController::class, 'info']);

Route::post('register', [\App\Http\Controllers\RegisterController::class, 'register']);
Route::post('login', [\App\Http\Controllers\RegisterController::class, 'login']);

Route::middleware('auth:api')->group( function () {
    Route::get('me', [\App\Http\Controllers\RegisterController::class, 'user']);
    Route::post('change', [\App\Http\Controllers\RegisterController::class, 'change']);
});
