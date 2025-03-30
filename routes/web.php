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
Route::delete('/admin/remove-student/{id}', [AdminController::class, 'removeStudent'])->name('admin.remove.student');
Route::get('/admin/students', [AdminController::class, 'viewStudents'])->name('admin.view.students');

Route::get('/register-teacher', [AdminController::class, 'showRegisterTeacherForm'])->name('admin.register.teacher');
Route::post('/register-teacher', [AdminController::class, 'storeTeacher'])->name('admin.store.teacher');
Route::get('/admin/view-teachers', [AdminController::class, 'viewTeachers'])->name('admin.view.teachers');

Route::get('/admin/add-subject', [AdminController::class, 'showAddSubjectForm'])->name('admin.add.subjects');
Route::post('/admin/store-subject', [AdminController::class, 'storeSubject'])->name('admin.store.subject');


require __DIR__.'/auth.php';
