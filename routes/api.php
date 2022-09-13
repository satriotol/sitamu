<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\UserVisitorController;
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

// Route::middleware('auth:sanctum')->get('user', function (Request $request) {
//     return $request->user();
// });
Route::middleware('auth:sanctum')->group(function () {
    Route::get('user', [AuthController::class, 'user']);
    Route::post('user_update', [AuthController::class, 'user_update']);
    Route::post('user_visitor', [UserVisitorController::class, 'user_visitor']);
    Route::get('user_visitor/list', [UserVisitorController::class, 'list_visitor']);
});
Route::get('getSurvey', [UserVisitorController::class, 'getSurvey']);
Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
