<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Grades | Umbrella Academy</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen">
    @include('layouts.nav')

    <div class="container mx-auto mt-10 p-6 bg-white shadow-md rounded-lg">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Grades for {{ $class->name }}</h2>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300 rounded-lg">
                <thead class="bg-gray-200 text-sm font-semibold text-gray-700">
                    <tr>
                        <th class="px-4 py-3 border-b border-gray-300">Subject</th>
                        <th class="px-4 py-3 border-b border-gray-300">Prelims</th>
                        <th class="px-4 py-3 border-b border-gray-300">Midterms</th>
                        <th class="px-4 py-3 border-b border-gray-300">Finals</th>
                        <th class="px-4 py-3 border-b border-gray-300">Final Grade</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($grades as $grade)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 border-b border-gray-200">{{ $grade->subject->name }}</td>
                            <td class="px-4 py-3 border-b border-gray-200">{{ $grade->prelims ?? 'N/A' }}</td>
                            <td class="px-4 py-3 border-b border-gray-200">{{ $grade->midterms ?? 'N/A' }}</td>
                            <td class="px-4 py-3 border-b border-gray-200">{{ $grade->finals ?? 'N/A' }}</td>
                            <td class="px-4 py-3 border-b border-gray-200 font-semibold text-gray-700">
                                {{ $grade->final_grade ?? 'N/A' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-gray-500 py-4">No grades available for this class yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
