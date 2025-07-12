<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IssueController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\PageController;

// หน้าแบบฟอร์มแจ้งปัญหา
Route::get('/', [IssueController::class, 'create']);
Route::post('/issues', [IssueController::class, 'store'])->name('issues.store');

// ระบบแอดมิน Login
Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

// ระบบหลังบ้านและแดชบอร์ด (เฉพาะ admin)
Route::middleware('auth:admin')->group(function () {
    Route::get('/admin/dashboard', [IssueController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/issues', [IssueController::class, 'index'])->name('admin.issues.index');
    Route::get('/admin/issues/{id}/reply', [IssueController::class, 'reply'])->name('admin.issues.reply');
    Route::post('/admin/issues/{id}/status', [IssueController::class, 'toggleStatus'])->name('admin.issues.toggleStatus');
    Route::delete('/admin/issues/{id}', [IssueController::class, 'destroy'])->name('admin.issues.destroy');
    Route::post('/admin/issues/{id}/reply', [IssueController::class, 'submitReply'])->name('admin.issues.submitReply');
});

// FAQ
Route::get('/faq', [PageController::class, 'faq'])->name('faq');

// API (ใช้หรือไม่ใช้ขึ้นอยู่กับระบบ)
Route::get('/api/rooms/{building_id}', [IssueController::class, 'getRooms']);
Route::get('/api/equipments/{room_id}', [IssueController::class, 'getEquipments']);
Route::view('/faq', 'faq')->name('faq');
