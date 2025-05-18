<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Schedule | Umbrella Academy</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen">
    @include('layouts.nav')

    <div class="container mx-auto mt-8 p-6 bg-white shadow-md rounded-lg">
        <h2 class="text-2xl font-bold mb-4">Class Schedule</h2>
        
        @if($schedules->isEmpty())
            <p class="text-gray-500">No schedules available.</p>
        @else
            <table class="w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border border-gray-300 px-4 py-2">Class Name</th>
                        <th class="border border-gray-300 px-4 py-2">Day</th>
                        <th class="border border-gray-300 px-4 py-2">Start Time</th>
                        <th class="border border-gray-300 px-4 py-2">End Time</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($schedules as $schedule)
                        <tr>
                            <td class="border border-gray-300 px-4 py-2">{{ $schedule->class->name }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $schedule->day }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ date('h:i A', strtotime($schedule->start_time)) }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ date('h:i A', strtotime($schedule->end_time)) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</body>
</html>
