<?php
use App\Http\Controllers\ComputerController;
use App\Http\Controllers\IssueController;
use Illuminate\Support\Facades\Route;


// Danh sách vấn đề
Route::get('/', [IssueController::class, 'index'])->name('issues.index');

// Hiển thị form tạo mới
Route::get('/issues/create', [IssueController::class, 'create'])->name('issues.create');

// Hiển thị chi tiết một vấn đề (nếu cần)
Route::get('/issues/{id}', [IssueController::class, 'show'])->name('issues.show');

// Hiển thị form chỉnh sửa
Route::get('/issues/{id}/edit', [IssueController::class, 'edit'])->name('issues.edit');

// Lưu vấn đề mới (POST)
Route::post('/issues', [IssueController::class, 'store'])->name('issues.store');

// Cập nhật thông tin vấn đề (PUT/PATCH)
Route::put('/issues/{id}', [IssueController::class, 'update'])->name('issues.update');

// Xóa vấn đề (DELETE)
Route::delete('/issues/{id}', [IssueController::class, 'destroy'])->name('issues.destroy');
