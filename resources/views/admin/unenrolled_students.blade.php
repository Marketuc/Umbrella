<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile | Umbrella Academy</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen">

@include('layouts.nav')

    <!-- Unenrolled Students Table -->
    <div class="container mx-auto mt-8 p-6 bg-white shadow-md rounded-lg">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Unenrolled Students</h2>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border p-2">Name</th>
                    <th class="border p-2">Email</th>
                    <th class="border p-2">Program</th>
                    <th class="border p-2">Phone</th>
                    <th class="border p-2">Documents</th>
                    <th class="border p-2">Action</th>
                </tr>
            </thead>
            <tbody>
            @forelse($students as $student)
<tr>
    <td class="border p-2">{{ $student->name }}</td>
    <td class="border p-2">{{ $student->email }}</td>
    <td class="border p-2">{{ $student->program }}</td>
    <td class="border p-2">{{ $student->phone }}</td>
    <td class="border p-2">
    @if($student->photo)
        <button onclick="showPhotoModal('{{ asset('storage/' . $student->photo) }}')" 
            class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-700">
            View Documents
        </button>
    @else
        <span class="text-red-500">No Documents</span>
    @endif
</td>
    <td class="border p-2 flex space-x-2">
        <!-- Approve Button -->
        <form action="{{ route('admin.approve.student', $student->id) }}" method="POST">
            @csrf
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">
                Approve
            </button>
        </form>

        <!-- Remove Button -->
        <form action="{{ route('admin.remove.student', $student->id) }}" method="POST"
              onsubmit="return confirm('Are you sure you want to remove this student?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-700">
                Remove
            </button>
        </form>
    </td>
</tr>
@empty
<tr>
    <td colspan="5" class="text-center p-4">No unenrolled students found.</td>
</tr>
@endforelse


            </tbody>
        </table>
    </div>

<div id="photoModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white p-4 rounded-lg shadow-lg">
        <img id="modalPhoto" src="" alt="Student Photo" class="max-w-full h-auto rounded-lg">
        <button onclick="closePhotoModal()" class="mt-4 bg-red-500 text-white px-4 py-1 rounded hover:bg-red-600">
            Close
        </button>
    </div>
</div>

<script>
    function showPhotoModal(photoUrl) {
        document.getElementById('modalPhoto').src = photoUrl;
        document.getElementById('photoModal').classList.remove('hidden');
    }

    function closePhotoModal() {
        document.getElementById('photoModal').classList.add('hidden');
    }
</script>

</body>
</html>
