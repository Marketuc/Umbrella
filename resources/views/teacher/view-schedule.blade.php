<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Schedule | Umbrella Academy</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- FullCalendar CSS -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen">
    @include('layouts.nav')

    <div class="container mx-auto mt-8 p-6 bg-white shadow-md rounded-lg">
        <h2 class="text-2xl font-bold mb-4">My Teaching Schedule</h2>
        
        @if($schedules->isEmpty())
            <p class="text-gray-500">No schedules assigned.</p>
        @else
            <!-- Table View -->
            <table class="w-full border-collapse border border-gray-300 mb-10">
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

            <!-- Calendar View -->
            <h3 class="text-xl font-semibold mb-4">Weekly Calendar View</h3>
            <div id="calendar"></div>
        @endif
    </div>

    <!-- FullCalendar JS -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const calendarEl = document.getElementById('calendar');

            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'timeGridWeek',
                allDaySlot: false,
                slotMinTime: '06:00:00',
                slotMaxTime: '22:00:00',
                height: 'auto',
                headerToolbar: {
                    left: '',
                    center: 'title',
                    right: ''
                },
                events: [
                    @php
                        $dayMap = [
                            'sunday' => 0,
                            'monday' => 1,
                            'tuesday' => 2,
                            'wednesday' => 3,
                            'thursday' => 4,
                            'friday' => 5,
                            'saturday' => 6,
                        ];
                    @endphp

                    @foreach($schedules as $schedule)
                        {
                            title: '{{ $schedule->class->name }}',
                            daysOfWeek: [{{ $dayMap[strtolower($schedule->day)] ?? 0 }}],
                            startTime: '{{ \Carbon\Carbon::parse($schedule->start_time)->format("H:i:s") }}',
                            endTime: '{{ \Carbon\Carbon::parse($schedule->end_time)->format("H:i:s") }}',
                            display: 'block'
                        },
                    @endforeach
                ]
            });

            calendar.render();
        });
    </script>
</body>
</html>
