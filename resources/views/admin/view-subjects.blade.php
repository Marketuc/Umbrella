<!-- resources/views/admin/view-teachers.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Teachers | Umbrella Academy</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen">
    @include('layouts.nav')

    <div class="container mx-auto mt-8 p-4 bg-white shadow-lg rounded-lg">
    <h2 class="text-xl font-bold mb-4">Subjects List</h2>
    <table class="min-w-full bg-white border border-gray-300">
        <thead>
            <tr>
                <th class="border px-4 py-2">Name</th>
                <th class="border px-4 py-2">Code</th>
                <th class="border px-4 py-2">Description</th>
                <th class="border px-4 py-2">Teacher Assigned</th>
                <th class="border px-4 py-2">Action</th>
            </tr>
        </thead>
        <tbody class="text-gray-700">
            @foreach($subjects as $subject)
            <tr class="hover:bg-gray-100">
                <td class="border px-6 py-3">{{ $subject->name }}</td>
                <td class="border px-6 py-3">{{ $subject->code }}</td>
                <td class="border px-6 py-3">{{ $subject->description }}</td>
                <td class="border px-6 py-3">{{ $subject->teacher->name ?? 'N/A' }}</td>
                <td class="border px-6 py-3 flex space-x-2">
                    <a href="#" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">Edit</a>
                    <a href="#" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-blue-700">Delete</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


