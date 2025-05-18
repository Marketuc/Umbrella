<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
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
Route::get('/admin/students/{id}/edit', [AdminController::class, 'editStudent'])->name('admin.edit.student');
Route::put('/admin/students/{id}', [AdminController::class, 'updateStudent'])->name('admin.update.student');

Route::get('/register-teacher', [AdminController::class, 'showRegisterTeacherForm'])->name('admin.register.teacher');
Route::post('/register-teacher', [AdminController::class, 'storeTeacher'])->name('admin.store.teacher');
Route::get('/admin/view-teachers', [AdminController::class, 'viewTeachers'])->name('admin.view.teachers');
Route::put('/teacher/update/{id}', [AdminController::class, 'updateTeacher'])->name('admin.update.teacher');
Route::get('/admin/teachers/{id}/edit', [AdminController::class, 'editTeacher'])->name('admin.edit.teacher');
Route::delete('/admin/teachers/{id}', [AdminController::class, 'deleteTeacher'])->name('admin.delete.teacher');


Route::get('/admin/add-subject', [AdminController::class, 'showAddSubjectForm'])->name('admin.add.subjects');
Route::post('/admin/store-subject', [AdminController::class, 'storeSubject'])->name('admin.store.subject');
Route::get('/admin/view-subjects', [AdminController::class, 'viewSubjects'])->name('admin.view.subjects');
Route::get('/subject/edit/{id}', [AdminController::class, 'editSubject'])->name('admin.subject.edit');
Route::put('/subject/update/{id}', [AdminController::class, 'updateSubject'])->name('admin.subject.update');
Route::delete('/subject/delete/{id}', [AdminController::class, 'deleteSubject'])->name('admin.subject.delete');

Route::get('/admin/class/create', [AdminController::class, 'createClass'])->name('admin.create.class');
Route::post('/admin/class/store', [AdminController::class, 'storeClass'])->name('admin.store.class');
Route::get('/admin/view-classes', [AdminController::class, 'viewClasses'])->name('admin.view.classes');
Route::get('/admin/classes/{id}/edit', [AdminController::class, 'editClass'])->name('admin.edit.class');
Route::put('/admin/classes/{id}', [AdminController::class, 'updateClass'])->name('admin.update.class');
Route::delete('/admin/classes/{id}', [AdminController::class, 'deleteClass'])->name('admin.delete.class');

Route::get('/student/view-schedule', [StudentController::class, 'viewSchedule'])->name('student.view.classes');
    Route::get('/classes', [StudentController::class, 'viewAvailableClasses'])->name('student.grade.classes');
    Route::get('/grades/{classId}', [StudentController::class, 'viewGradesForClass'])->name('student.grades');


//teacher
Route::get('teacher/schedule', [TeacherController::class, 'viewTeacherSchedule'])
    ->name('teacher.schedule')
    ->middleware('auth');
Route::get('teacher/enter-grade/{class}/{subject}', [TeacherController::class, 'enterGradeForm'])->name('teacher.enter.grade');
Route::post('teacher/store-grade', [TeacherController::class, 'storeGrades'])->name('teacher.store.grades');
Route::get('/teacher/classes', [TeacherController::class, 'viewAssignedClasses'])->name('teacher.classes');




require __DIR__.'/auth.php';
