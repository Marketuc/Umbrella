<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Subject | Umbrella Academy</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen">

@include('layouts.nav')

    <!-- Add Subject Form -->
    <div class="container mx-auto mt-8 p-6 bg-white shadow-md rounded-lg">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Add New Subject</h2>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.store.subject') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 gap-4">
                <div>
                    <label class="block font-medium">Subject Name</label>
                    <input type="text" name="name" class="w-full p-2 border rounded" required>
                </div>
                <div>
                    <label class="block font-medium">Subject Code</label>
                    <input type="text" name="code" class="w-full p-2 border rounded" required>
                </div>
                <div>
                    <label class="block font-medium">Description</label>
                    <textarea name="description" class="w-full p-2 border rounded"></textarea>
                </div>
                <div>
                    <label class="block font-medium">Assign Teacher</label>
                    <select name="teacher_id" class="w-full p-2 border rounded" required>
                        <option value="">Select a Teacher</option>
                        @foreach($teachers as $teacher)
                            <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="mt-4">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Add Subject
                </button>
            </div>
        </form>
    </div>

</body>
</html>
