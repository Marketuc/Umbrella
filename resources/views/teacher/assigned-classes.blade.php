<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Classes | Umbrella Academy</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- FullCalendar CSS -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen">
    @include('layouts.nav')
<div class="container mx-auto p-6 bg-white shadow-md rounded-lg">
    <h2 class="text-2xl font-bold mb-4">My Classes</h2>

    @if($classes->isEmpty())
        <p class="text-gray-500">No classes assigned.</p>
    @else
        <ul class="space-y-4">
            @foreach($classes as $class)
                <li class="border p-4 rounded-lg">
                    <div class="font-semibold text-lg">{{ $class->name }}</div>
                    <div class="mt-2">
                        <p class="text-gray-700">Subjects:</p>
                        <ul class="ml-4 list-disc">
                            @foreach($class->subjects as $subject)
                                <li>
                                    {{ $subject->name }}
                                    <a href="{{ route('teacher.enter.grade', ['class' => $class->id, 'subject' => $subject->id]) }}" class="text-blue-600 hover:underline ml-2">
                                        Enter Grades
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </li>
            @endforeach
        </ul>
    @endif
</div>
