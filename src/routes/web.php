<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

Route::middleware('auth')->group(function () {
    Route::get('/attendance', [AuthController::class, 'attendance_index']);
    Route::post('/attendance', [AuthController::class, 'attendance_store']);
    Route::get('/admin/attendance/list', [AuthController::class, 'admin_index']);
});

// 勤怠一覧画面
Route::get('/admin/attendance/list', [AuthController::class, 'admin_index']);
// 勤怠詳細画面
Route::get('/admin/attendance', [AuthController::class, 'admin_detail']);
// スタッフ一覧画面
Route::get('/admin/staff/list', [AuthController::class, 'staff_list']);
// スタッフ別勤怠一覧画面
Route::get('/admin/attendance/staff/id', [AuthController::class, 'staff_detail']);
// 申請一覧画面
Route::get('/stamp_correction_request/list', [AuthController::class, 'request_list']);
// スタッフ勤怠管理画面
Route::get('/attendance', [AuthController::class, 'index']);