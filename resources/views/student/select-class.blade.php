<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Class | Umbrella Academy</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen">
    @include('layouts.nav')

    <div class="container mx-auto mt-10 p-6 bg-white shadow-md rounded-lg">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Select a Class</h2>

        @if($classes->count())
            <ul class="space-y-4">
                @foreach($classes as $class)
                    <li>
                        <a href="{{ route('student.grades', $class->id) }}"
                           class="text-blue-600 hover:text-blue-800 underline font-medium">
                            {{ $class->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="text-gray-600">You are not enrolled in any classes.</p>
        @endif
    </div>
</body>
</html>
