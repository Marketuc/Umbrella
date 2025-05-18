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

class TeacherController extends Controller
{
public function viewTeacherSchedule()
{
    $teacherId = Auth::id(); // Get current logged-in teacher's ID

    $schedules = ClassSchedule::whereHas('class', function ($query) use ($teacherId) {
        $query->where('teacher_id', $teacherId);
    })->with('class')->get();

    return view('teacher.view-schedule', compact('schedules'));
}

public function enterGradeForm($classId, $subjectId)
{
    $students = ClassStudent::where('class_id', $classId)
        ->with(['student' => function ($query) use ($classId, $subjectId) {
            $query->with(['grade' => function ($q) use ($classId, $subjectId) {
                $q->where('class_id', $classId)
                  ->where('subject_id', $subjectId);
            }]);
        }])
        ->get();

    return view('teacher.enter-grade', compact('students', 'classId', 'subjectId'));
}


public function storeGrades(Request $request)
{
    $grades = $request->input('grades'); // returns array of student_id => [prelims, midterms, finals]

foreach ($grades as $studentId => $gradeSet) {
    $prelims = $gradeSet['prelims'] ?? 0;
    $midterms = $gradeSet['midterms'] ?? 0;
    $finals = $gradeSet['finals'] ?? 0;

    $finalGrade = round(($prelims + $midterms + $finals) / 3, 2); // adjust weight logic as needed

    // Save to a 'grades' table (you must create this table if not yet done)
    Grade::updateOrCreate(
        [
            'student_id' => $studentId,
            'class_id' => $request->class_id,
            'subject_id' => $request->subject_id,
        ],
        [
            'prelims' => $prelims,
            'midterms' => $midterms,
            'finals' => $finals,
            'final_grade' => $finalGrade,
        ]
    );
}


    return redirect()->back()->with('success', 'Grades saved successfully.');
}

public function viewAssignedClasses()
{
    $teacherId = Auth::id();

    $classes = Classroom::where('teacher_id', $teacherId)->with('subjects')->get();

    return view('teacher.assigned-classes', compact('classes'));
}

}
