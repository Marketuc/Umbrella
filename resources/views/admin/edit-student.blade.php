<!-- resources/views/admin/edit-student.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student | Umbrella Academy</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen">
    @include('layouts.nav')

    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Edit Student</h1>

        <div class="bg-white shadow-md rounded-lg p-6">
            <form action="{{ route('admin.update.student', $student->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2" for="name">Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $student->name) }}" class="w-full border rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2" for="email">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $student->email) }}" class="w-full border rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2" for="program">Program</label>
                    <input type="text" id="program" name="program" value="{{ old('program', $student->program) }}" class="w-full border rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2" for="phone">Phone</label>
                    <input type="text" id="phone" name="phone" value="{{ old('phone', $student->phone) }}" class="w-full border rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-2" for="enrolled">Enrollment Status</label>
                    <select id="enrolled" name="enrolled" class="w-full border rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <option value="1" {{ old('enrolled', $student->enrolled) == 1 ? 'selected' : '' }}>Enrolled</option>
                        <option value="0" {{ old('enrolled', $student->enrolled) == 0 ? 'selected' : '' }}>Not Enrolled</option>
                    </select>
                </div>

                <div class="flex justify-end">
                    <a href="{{ route('admin.view.students') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 mr-2">Cancel</a>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update Student</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
