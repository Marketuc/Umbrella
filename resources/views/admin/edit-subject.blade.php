<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Edit Subject | Umbrella Academy</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen">
    @include('layouts.nav')

    <div class="container mx-auto mt-8 p-6 bg-white shadow-lg rounded-lg max-w-lg">
        <h2 class="text-2xl font-bold mb-6">Edit Subject</h2>

        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>- {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.subject.update', $subject->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-semibold mb-2">Subject Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $subject->name) }}"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600" required />
            </div>

            <div class="mb-4">
                <label for="code" class="block text-gray-700 font-semibold mb-2">Subject Code</label>
                <input type="text" name="code" id="code" value="{{ old('code', $subject->code) }}"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600" required />
            </div>

            <div class="mb-4">
                <label for="description" class="block text-gray-700 font-semibold mb-2">Description</label>
                <textarea name="description" id="description"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600"
                    rows="4">{{ old('description', $subject->description) }}</textarea>
            </div>

            <div class="flex space-x-4">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Update</button>
                <a href="{{ route('admin.view.subjects') }}" class="bg-gray-400 text-white px-6 py-2 rounded hover:bg-gray-500">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>
