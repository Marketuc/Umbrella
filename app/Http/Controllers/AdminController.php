<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function showUnenrolledStudents()
    {
        $students = User::where('user_type', 'student')->where('enrolled', 0)->get();
        return view('admin.unenrolled_students', compact('students'));
    }

    public function approveStudent($id)
    {
        $student = User::findOrFail($id);
        $student->enrolled = 1;
        $student->save();

        return redirect()->back()->with('success', 'Student has been enrolled successfully!');
    }
}