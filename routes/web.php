<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [RegisterController::class, 'show'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);


Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show'); // View Profile
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit'); // Edit Profile
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update'); // Update Profile
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy'); // Delete Account
});


Route::get('/admin/unenrolled-students', [AdminController::class, 'showUnenrolledStudents'])->name('admin.unenrolled.students');
Route::post('/admin/approve-student/{id}', [AdminController::class, 'approveStudent'])->name('admin.approve.student');

require __DIR__.'/auth.php';
