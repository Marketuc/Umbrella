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

    <div class="container mx-auto mt-8">
        <h2 class="text-2xl font-bold mb-4">Teachers List</h2>
        <div class="bg-white p-6 rounded shadow-md">
            <table class="w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border px-4 py-2">ID</th>
                        <th class="border px-4 py-2">Name</th>
                        <th class="border px-4 py-2">Email</th>
                        <th class="border px-4 py-2">Department</th>
                        <th class="border px-4 py-2">Phone</th>
                        <th class="border px-4 py-2">Photo</th>
                        <th class="border px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($teachers as $teacher)
                        <tr class="text-center">
                            <td class="border px-4 py-2">{{ $teacher->id }}</td>
                            <td class="border px-4 py-2">{{ $teacher->name }}</td>
                            <td class="border px-4 py-2">{{ $teacher->email }}</td>
                            <td class="border px-4 py-2">{{ $teacher->program }}</td>
                            <td class="border px-4 py-2">{{ $teacher->phone }}</td>
                            <td class="border py-2 px-4">
                @if($teacher->photo)
                    <button onclick="showPhotoModal('{{ asset('storage/' . $teacher->photo) }}')"
                        class="bg-blue-500 text-white px-4 py-1 rounded hover:bg-blue-600">
                        View Documents
                    </button>
                @else
                    <span class="text-gray-500">No Documents</span>
                @endif
            </td>
                            <td class="border px-4 py-2">
                                <a href="#" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">Edit</a>
                                <a href="#" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-blue-700">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
        <!-- Photo Modal -->
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
