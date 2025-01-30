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