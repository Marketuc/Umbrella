<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enter Grades | Umbrella Academy</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- FullCalendar CSS (optional if not used here) -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen">
    @include('layouts.nav')

    <div class="container mx-auto mt-10 p-6 bg-white shadow-md rounded-lg">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Enter Grades</h2>

        <form method="POST" action="{{ route('teacher.store.grades') }}">
            @csrf
            <input type="hidden" name="class_id" value="{{ $classId }}">
            <input type="hidden" name="subject_id" value="{{ $subjectId }}">

            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-300 rounded-lg">
                    <thead>
    <tr class="bg-gray-200 text-left text-sm font-semibold text-gray-700">
        <th class="px-4 py-3 border-b border-gray-300">Student Name</th>
        <th class="px-4 py-3 border-b border-gray-300">Prelims</th>
        <th class="px-4 py-3 border-b border-gray-300">Midterms</th>
        <th class="px-4 py-3 border-b border-gray-300">Finals</th>
        <th class="px-4 py-3 border-b border-gray-300">Final Grade</th>
    </tr>
</thead>
<tbody>
    <!-- ... inside your <tbody> -->
@foreach ($students as $cs)
    <tr class="hover:bg-gray-50">
    <td class="px-4 py-3 border-b border-gray-200">{{ $cs->student->name }}</td>

    <td class="px-4 py-3 border-b border-gray-200">
        <input 
            type="number" 
            step="0.01" 
            name="grades[{{ $cs->student->id }}][prelims]" 
            value="{{ optional($cs->student->grade)->prelims }}"
            class="grade-input w-full border border-gray-300 rounded px-3 py-2"
            data-type="prelims"
            data-student="{{ $cs->student->id }}"
        >
    </td>

    <td class="px-4 py-3 border-b border-gray-200">
        <input 
            type="number" 
            step="0.01" 
            name="grades[{{ $cs->student->id }}][midterms]" 
            value="{{ optional($cs->student->grade)->midterms }}"
            class="grade-input w-full border border-gray-300 rounded px-3 py-2"
            data-type="midterms"
            data-student="{{ $cs->student->id }}"
        >
    </td>

    <td class="px-4 py-3 border-b border-gray-200">
        <input 
            type="number" 
            step="0.01" 
            name="grades[{{ $cs->student->id }}][finals]" 
            value="{{ optional($cs->student->grade)->finals }}"
            class="grade-input w-full border border-gray-300 rounded px-3 py-2"
            data-type="finals"
            data-student="{{ $cs->student->id }}"
        >
    </td>

    <td class="px-4 py-3 border-b border-gray-200">
        <input 
            type="text" 
            class="final-grade w-full border border-gray-300 rounded px-3 py-2 bg-gray-100 text-gray-600"
            data-student="{{ $cs->student->id }}"
            value="{{ optional($cs->student->grade)->final_grade }}"
            readonly
        >
    </td>
</tr>

@endforeach

</tbody>

                </table>
            </div>

            <div class="mt-6 text-right">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-lg shadow">
                    Save Grades
                </button>
            </div>
        </form>
    </div>
</body>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const gradeInputs = document.querySelectorAll('.grade-input');

        gradeInputs.forEach(input => {
            input.addEventListener('input', function () {
                const studentId = this.dataset.student;

                const prelimInput = document.querySelector(`.grade-input[data-student="${studentId}"][data-type="prelims"]`);
                const midtermInput = document.querySelector(`.grade-input[data-student="${studentId}"][data-type="midterms"]`);
                const finalInput = document.querySelector(`.grade-input[data-student="${studentId}"][data-type="finals"]`);
                const finalGradeInput = document.querySelector(`.final-grade[data-student="${studentId}"]`);

                const prelim = parseFloat(prelimInput.value) || 0;
                const midterm = parseFloat(midtermInput.value) || 0;
                const finals = parseFloat(finalInput.value) || 0;

                const finalGrade = (prelim * 0.3 + midterm * 0.3 + finals * 0.4).toFixed(2);

                finalGradeInput.value = finalGrade;
            });
        });
    });
</script>

</html>
