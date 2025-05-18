<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Class | Umbrella Academy</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen">
@include('layouts.nav')

<div class="container mx-auto mt-10 p-6 bg-white rounded shadow-lg">
    <h1 class="text-2xl font-bold mb-4">Edit Class</h1>

    <form method="POST" action="{{ route('admin.update.class', $class->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block font-medium">Class Name</label>
            <input type="text" name="name" value="{{ $class->name }}" required class="w-full border p-2 rounded">
        </div>

        <div class="mb-4">
            <label class="block font-medium">Teacher</label>
            <select name="teacher_id" class="w-full border p-2 rounded">
                <option value="">-- Select Teacher --</option>
                @foreach($teachers as $teacher)
                    <option value="{{ $teacher->id }}" {{ $class->teacher_id == $teacher->id ? 'selected' : '' }}>
                        {{ $teacher->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block font-medium">Day</label>
            <input type="text" name="day" value="{{ $classSchedule->day ?? '' }}" class="w-full border p-2 rounded">
        </div>

        <div class="mb-4">
            <label class="block font-medium">Start Time</label>
            <input type="time" name="start_time" value="{{ $classSchedule->start_time ?? '' }}" class="w-full border p-2 rounded">
        </div>

        <div class="mb-4">
            <label class="block font-medium">End Time</label>
            <input type="time" name="end_time" value="{{ $classSchedule->end_time ?? '' }}" class="w-full border p-2 rounded">
        </div>

        <div class="mb-4">
            <label class="block font-medium">Assign Students</label>
            <div class="grid grid-cols-2 gap-2 max-h-48 overflow-y-auto border p-2 rounded">
                @foreach($students as $student)
                    <label class="flex items-center">
                        <input type="checkbox" name="students[]" value="{{ $student->id }}"
                            {{ in_array($student->id, $assignedStudents) ? 'checked' : '' }}>
                        <span class="ml-2">{{ $student->name }}</span>
                    </label>
                @endforeach
            </div>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Update Class</button>
        </div>
    </form>
</div>
</body>
</html>
