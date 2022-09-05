<?php

use App\Http\Controllers\CctvController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Frontend\AuthController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SurveyQuestionController;
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

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login_post');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'register_post'])->name('register_post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout_post');
Route::group(['middleware' => ['auth']], function() {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('cctv', CctvController::class);
    Route::resource('user', UserController::class);
    Route::resource('user_need', UserNeedController::class);
    Route::post('user_need/visitor', [UserNeedController::class, 'user_need_visitor'])->name('user_need.visitor');
    Route::post('user_need/change_status/{user_need}', [UserNeedController::class, 'changeStatus'])->name('user_need.changeStatus');
    Route::resource('user_detail', UserDetailController::class);
    Route::resource('role', RoleController::class);
    Route::resource('permission', PermissionController::class);
    Route::resource('surveyQuestion', SurveyQuestionController::class);
});
