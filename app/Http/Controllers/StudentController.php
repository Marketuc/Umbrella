<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use App\Models\Subject;
use App\Models\Classroom;
use App\Models\ClassSubject;
use App\Models\ClassStudent;
use App\Models\ClassSchedule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Grade;

class StudentController extends Controller
{
    public function viewSchedule() {
        $schedules = ClassSchedule::with('class')->get();
        return view('student/view-schedule', compact('schedules'));
    }
    
public function viewAvailableClasses()
{
    $studentId = auth()->id();

    $classes = ClassStudent::with('classroom')
        ->where('student_id', $studentId)
        ->get()
        ->pluck('classroom')
        ->unique('id'); // avoid duplicate class entries

    return view('student.select-class', compact('classes'));
}

public function viewGradesForClass($classId)
{
    $studentId = auth()->id();

    $grades = Grade::with('subject')
        ->where('student_id', $studentId)
        ->where('class_id', $classId)
        ->get();

    $class = Classroom::findOrFail($classId); // if you have a SchoolClass model

    return view('student.view-grades', compact('grades', 'class'));
}

}
