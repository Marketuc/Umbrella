<!-- resources/views/admin/view-classes.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Classes | Umbrella Academy</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen">
    @include('layouts.nav')
    
    <div class="container mx-auto mt-8 p-6 bg-white shadow-lg rounded-lg">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Class Details</h2>
        <table class="w-full border-collapse bg-white shadow-md rounded-lg overflow-hidden">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="border px-6 py-3">Class Name</th>
                    <th class="border px-6 py-3">Teacher</th>
                    <th class="border px-6 py-3">Day</th>
                    <th class="border px-6 py-3">Start Time</th>
                    <th class="border px-6 py-3">End Time</th>
                    <th class="border px-6 py-3">Students</th>
                    <th class="border px-6 py-3">Subjects Assigned</th>
                    <th class="border px-6 py-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($classes as $class)
                <tr class="hover:bg-gray-100">
                    <td class="border px-6 py-3">{{ $class->name }}</td>
                    <td class="border px-6 py-3">{{ $class->teacher->name ?? 'Unassigned' }}</td>
                    
                    @php
                        $schedule = $schedules->where('class_id', $class->id)->first();
                        $studentsList = $students->where('class_id', $class->id);
                        $subjectsList = $subjects->where('class_id', $class->id);
                    @endphp
                    
                    <td class="border px-6 py-3" colspan="3">
    @php
        $classSchedules = $schedules->where('class_id', $class->id);
    @endphp

    @forelse($classSchedules as $schedule)
        <div>
            <strong>{{ $schedule->day }}:</strong>
            {{ \Carbon\Carbon::parse($schedule->start_time)->format('h:i A') }} - 
            {{ \Carbon\Carbon::parse($schedule->end_time)->format('h:i A') }}
        </div>
    @empty
        N/A
    @endforelse
</td>

                    
                    <td class="border px-6 py-3">
    {{ $studentsList->count() }} student{{ $studentsList->count() !== 1 ? 's' : '' }}
</td>
                    
                    <td class="border px-6 py-3">
                        @foreach($subjectsList as $cs)
                            {{ $cs->subject->name ?? 'N/A' }}<br>
                        @endforeach
                    </td>
                    
                    <td class="border px-6 py-3">
    <a href="{{ route('admin.edit.class', $class->id) }}" class="text-blue-500 hover:underline">Edit</a>
    
    <form action="{{ route('admin.delete.class', $class->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this class?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="text-red-500 hover:underline ml-2">Delete</button>
    </form>
</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
