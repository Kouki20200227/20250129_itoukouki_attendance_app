<?php

use App\Http\Controllers\AdminLoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LogoutController;
use Illuminate\Contracts\Cache\Store;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;
use Illuminate\Support\Facades\Auth;

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

// ユーザー認証のルートをオーバーライド
// ユーザー認証ルート
Route::prefix('/')->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);

    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);
});

// 管理者承認ルート
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('adminlogin');
    Route::post('/login', [AdminLoginController::class, 'login']);
});
Route::post('/logout', [LogoutController::class, 'destroy'])->name('logout');


// 一般ユーザーのアクセス
Route::middleware('auth')->group(function () {
    // 勤怠登録画面(一般ユーザー)
    Route::get('/attendance', [AuthController::class, 'index']);
    Route::post('/attendance', [AuthController::class, 'index_store']);
    // 勤怠一覧画面(一般ユーザー)
    Route::get('/attendance/list', [AuthController::class, 'work_list']);
});

// 管理者のアクセス
Route::middleware('auth:admin')->group(function () {
    // 勤怠一覧画面(管理者)
    Route::get('/admin/attendance/list', [AuthController::class, 'admin_index']);
    // 申請一覧画面
    Route::get('/stamp_correction_request/list', [AuthController::class, 'request_list']);
    // 勤怠詳細画面
    Route::get('/admin/attendance', [AuthController::class, 'admin_detail']);
    // スタッフ一覧画面
    Route::get('/admin/staff/list', [AuthController::class, 'staff_list']);
    // スタッフ別勤怠一覧画面
    Route::get('/admin/attendance/staff/id', [AuthController::class, 'staff_detail']);
});