<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\Classroom;
use App\Models\ClassSubject;
use App\Models\ClassStudent;
use App\Models\ClassSchedule;
use App\Models\User;

class StudentController extends Controller
{
    public function viewSchedule() {
        $schedules = ClassSchedule::with('class')->get();
        return view('student/view-schedule', compact('schedules'));
    }
    
}
