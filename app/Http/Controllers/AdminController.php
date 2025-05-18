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


class AdminController extends Controller
{
    public function viewStudents()
{
    $students = User::where('user_type', 'student')->get();
    return view('admin.view-students', compact('students'));
}
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

    public function removeStudent($id)
    {
        $student = User::findOrFail($id);
        
        // Delete student documents if they exist
        if ($student->documents) {
            Storage::delete('public/' . $student->documents);
        }

        // Delete student record
        $student->delete();

        return back()->with('success', 'Student removed successfully.');
    }

    public function showRegisterTeacherForm()
    {
        return view('admin.register-teacher');
    }
    
    public function viewTeachers()
{
    $teachers = User::where('user_type', 'teacher')->get();
    return view('admin.view-teachers', compact('teachers'));
}

    /**
     * Store a new teacher.
     */
    public function storeTeacher(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'required|string|max:20',
            'dob' => 'nullable|date',
            'gender' => 'nullable|in:male,female,other',
            'program' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle photo upload
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('profile_photos', 'public');
        }

        // Create the teacher
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'dob' => $request->dob,
            'gender' => $request->gender,
            'program' => $request->program,
            'photo' => $photoPath,
            'user_type' => 'teacher',
        ]);

        return redirect()->route('admin.register.teacher')->with('success', 'Teacher registered successfully!');
    }

    public function showAddSubjectForm()
{
    $teachers = User::where('user_type', 'teacher')->get();
    return view('admin.add-subjects', compact('teachers'));
}

public function storeSubject(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'code' => 'required|string|max:50|unique:subjects,code',
        'description' => 'nullable|string',
        'teacher_id' => 'nullable|exists:users,id', // Ensure teacher exists
    ]);

    Subject::create([
        'name' => $request->name,
        'code' => $request->code,
        'description' => $request->description,
        'teacher_id' => $request->teacher_id,
    ]);

    return redirect()->route('admin.add.subjects')->with('success', 'Subject added successfully!');
}

public function viewSubjects()
{
    $subjects = Subject::with('teacher')->get();
    return view('admin.view-subjects', compact('subjects'));
}

public function createClass()
    {
        $teachers = User::where('user_type', 'teacher')->get();
        $students = User::where('user_type', 'student')->get();
        $subjects = Subject::all();
        return view('admin.add-class', compact('teachers', 'students', 'subjects'));
    }

    public function storeClass(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'teacher_id' => 'nullable|exists:users,id',
            'subject_ids' => 'array',
            'student_ids' => 'array',
            'days' => 'array',
            'start_times' => 'array',
            'end_times' => 'array',
        ]);

        // Create class
        $classroom = Classroom::create([
            'name' => $request->name,
            'teacher_id' => $request->teacher_id,
        ]);

        // Attach subjects
        if ($request->has('subject_ids')) {
            foreach ($request->subject_ids as $subject_id) {
                ClassSubject::create([
                    'class_id' => $classroom->id,
                    'subject_id' => $subject_id,
                ]);
            }
        }

        // Attach students
        if ($request->has('student_ids')) {
            foreach ($request->student_ids as $student_id) {
                ClassStudent::create([
                    'class_id' => $classroom->id,
                    'student_id' => $student_id,
                ]);
            }
        }

        // Add schedules
        if ($request->has('days')) {
            foreach ($request->days as $index => $day) {
                ClassSchedule::create([
                    'class_id' => $classroom->id,
                    'day' => $day,
                    'start_time' => $request->start_times[$index],
                    'end_time' => $request->end_times[$index],
                ]);
            }
        }

        return redirect()->route('admin.view.classes')->with('success', 'Class added successfully!');
    }
    public function viewClasses()
    {
        $classes = Classroom::with('teacher')->get();
        $schedules = ClassSchedule::with('classroom')->get();
        $students = ClassStudent::with('classroom', 'student')->get();
        $subjects = ClassSubject::with('classroom', 'subject')->get();

        return view('admin.view-class', compact('classes', 'schedules', 'students', 'subjects'));
    }

    public function editStudent($id)
{
    $student = User::where('user_type', 'student')->findOrFail($id);
    return view('admin.edit-student', compact('student'));
}

public function updateStudent(Request $request, $id)
{
    $student = User::where('user_type', 'student')->findOrFail($id);

    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $student->id,
        'program' => 'nullable|string|max:255',
        'phone' => 'nullable|string|max:20',
        'enrolled' => 'required|boolean',
    ]);

    $student->update($validated);

    return redirect()->route('admin.view.students')->with('success', 'Student updated successfully.');
}

public function editTeacher($id)
{
    $teacher = User::findOrFail($id);
    return view('admin.edit-teachers', compact('teacher'));
}

public function updateTeacher(Request $request, $id)
{
    $teacher = User::findOrFail($id);

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $teacher->id,
        'program' => 'nullable|string|max:255',
        'phone' => 'nullable|string|max:20',
        'photo' => 'nullable|image|max:2048', // max 2MB image
    ]);

    $teacher->name = $request->name;
    $teacher->email = $request->email;
    $teacher->program = $request->program;
    $teacher->phone = $request->phone;

    if ($request->hasFile('photo')) {
        // Delete old photo if exists
        if ($teacher->photo && Storage::exists('public/' . $teacher->photo)) {
            Storage::delete('public/' . $teacher->photo);
        }
        // Store new photo
        $path = $request->file('photo')->store('teachers', 'public');
        $teacher->photo = $path;
    }

    $teacher->save();

    return redirect()->route('admin.view.teachers')->with('success', 'Teacher updated successfully.');
}

public function deleteTeacher($id)
{
    $teacher = User::findOrFail($id);
    $teacher->delete();
    return redirect()->route('admin.view.teachers.update')->with('success', 'Teacher deleted successfully.');
}

public function editSubject($id)
{
    $subject = Subject::findOrFail($id);
    return view('admin.edit-subject', compact('subject'));
}

public function updateSubject(Request $request, $id)
{
    $subject = Subject::findOrFail($id);

    $request->validate([
        'name' => 'required|string|max:255',
        'code' => 'required|string|max:50|unique:subjects,code,' . $subject->id,
        'description' => 'nullable|string',
    ]);

    $subject->name = $request->name;
    $subject->code = $request->code;
    $subject->description = $request->description;
    $subject->save();

    return redirect()->route('admin.view.subjects')->with('success', 'Subject updated successfully.');
}

public function deleteSubject($id)
{
    $subject = Subject::findOrFail($id);
    $subject->delete();

    return redirect()->route('admin.view.subjects')->with('success', 'Subject deleted successfully.');
}


public function editClass($id)
{
    $class = Classroom::with('teacher')->findOrFail($id);
    $teachers = User::where('user_type', 'teacher')->get();
    $students = User::where('user_type', 'student')->get();
    $classSchedule = ClassSchedule::where('class_id', $id)->first();
    $assignedStudents = ClassStudent::where('class_id', $id)->pluck('student_id')->toArray();

    return view('admin.edit-class', compact('class', 'teachers', 'students', 'classSchedule', 'assignedStudents'));
}

public function updateClass(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string',
        'teacher_id' => 'nullable|exists:users,id',
        'day' => 'required|string',
        'start_time' => 'required',
        'end_time' => 'required',
        'students' => 'array',
    ]);

    $class = Classroom::findOrFail($id);
    $class->update([
        'name' => $request->name,
        'teacher_id' => $request->teacher_id,
    ]);

    ClassSchedule::updateOrCreate(
        ['class_id' => $id],
        ['day' => $request->day, 'start_time' => $request->start_time, 'end_time' => $request->end_time]
    );

    ClassStudent::where('class_id', $id)->delete();
    if ($request->students) {
        foreach ($request->students as $student_id) {
            ClassStudent::create([
                'class_id' => $id,
                'student_id' => $student_id,
            ]);
        }
    }

    return redirect()->route('admin.view.classes')->with('success', 'Class updated successfully.');
}

public function deleteClass($id)
{
    Classroom::destroy($id);
    ClassSchedule::where('class_id', $id)->delete();
    ClassStudent::where('class_id', $id)->delete();
    ClassSubject::where('class_id', $id)->delete();

    return redirect()->route('admin.view.classes')->with('success', 'Class deleted successfully.');
}


}