<?php

use App\Http\Controllers\CctvController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Frontend\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserDetailController;
use App\Http\Controllers\UserNeedController;
use Illuminate\Support\Facades\Route;

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

Route::get('register', []);
Route::get('/', [AuthController::class, 'index'])->name('frontend.login');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::prefix('admin')->group(function () {
    Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('cctv', CctvController::class);
        Route::resource('user', UserController::class);
        Route::resource('user_need', UserNeedController::class);
        Route::resource('user_detail', UserDetailController::class);
    });
});
