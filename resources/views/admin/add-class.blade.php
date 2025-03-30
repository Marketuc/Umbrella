<!-- resources/views/admin/add-class.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Class | Umbrella Academy</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen">
    @include('layouts.nav')
    
    <div class="container mx-auto mt-8 p-6 bg-white shadow-lg rounded-lg">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Add New Class</h2>
        
        <form action="{{ route('admin.store.class') }}" method="POST">
            @csrf
            
            <!-- Class Name -->
            <div class="mb-4">
                <label class="block text-gray-700">Class Name</label>
                <input type="text" name="name" class="w-full p-2 border rounded-lg" required>
            </div>

            <!-- Assign Teacher -->
            <div class="mb-4">
                <label class="block text-gray-700">Assign Teacher</label>
                <select name="teacher_id" class="w-full p-2 border rounded-lg">
                    <option value="">-- Select Teacher --</option>
                    @foreach($teachers as $teacher)
                        <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Assign Subjects -->
            <div class="mb-4">
                <label class="block text-gray-700">Assign Subjects</label>
                <select name="subject_ids[]" multiple class="w-full p-2 border rounded-lg">
                    @foreach($subjects as $subject)
                        <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                    @endforeach
                </select>
                <small class="text-gray-500">Hold Ctrl (Cmd on Mac) to select multiple subjects.</small>
            </div>

            <!-- Assign Students -->
            <div class="mb-4">
                <label class="block text-gray-700">Assign Students</label>
                <select name="student_ids[]" multiple class="w-full p-2 border rounded-lg">
                    @foreach($students as $student)
                        <option value="{{ $student->id }}">{{ $student->name }}</option>
                    @endforeach
                </select>
                <small class="text-gray-500">Hold Ctrl (Cmd on Mac) to select multiple students.</small>
            </div>

            <!-- Add Schedule -->
            <div class="mb-4">
                <label class="block text-gray-700">Schedule</label>
                <div id="schedule-container">
                    <div class="flex space-x-2 mb-2">
                        <select name="days[]" class="p-2 border rounded-lg">
                            <option value="Monday">Monday</option>
                            <option value="Tuesday">Tuesday</option>
                            <option value="Wednesday">Wednesday</option>
                            <option value="Thursday">Thursday</option>
                            <option value="Friday">Friday</option>
                            <option value="Saturday">Saturday</option>
                        </select>
                        <input type="time" name="start_times[]" class="p-2 border rounded-lg">
                        <input type="time" name="end_times[]" class="p-2 border rounded-lg">
                        <button type="button" onclick="addScheduleRow()" class="bg-green-500 text-white px-3 rounded-lg">+</button>
                    </div>
                </div>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Add Class</button>
            </div>
        </form>
    </div>

    <script>
        function addScheduleRow() {
            let container = document.getElementById('schedule-container');
            let newRow = `
                <div class="flex space-x-2 mb-2">
                    <select name="days[]" class="p-2 border rounded-lg">
                        <option value="Monday">Monday</option>
                        <option value="Tuesday">Tuesday</option>
                        <option value="Wednesday">Wednesday</option>
                        <option value="Thursday">Thursday</option>
                        <option value="Friday">Friday</option>
                        <option value="Saturday">Saturday</option>
                    </select>
                    <input type="time" name="start_times[]" class="p-2 border rounded-lg">
                    <input type="time" name="end_times[]" class="p-2 border rounded-lg">
                    <button type="button" onclick="this.parentElement.remove()" class="bg-red-500 text-white px-3 rounded-lg">-</button>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', newRow);
        }
    </script>
</body>
</html>
