<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile | Umbrella Academy</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen">

    <!-- Navbar -->
    <nav class="bg-[#001F3F] text-white p-4 shadow-md"> <!-- Deep Navy Blue -->
        <div class="container mx-auto flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <img src="{{ asset('storage/schoollogo.jpg') }}" alt="School Logo" class="h-10"> <!-- School Logo -->
                <a href="{{ route('dashboard') }}" class="text-lg font-bold">Umbrella Academy</a>
            </div>
            <div class="space-x-4">
                <a href="{{ route('dashboard') }}" class="hover:underline">Dashboard</a>
                @if(Auth::user()->user_type !== 'admin')
                <a href="{{ route('profile.show') }}" class="hover:underline">Profile</a>
                @endif

                @if(Auth::user()->user_type === 'admin')
                    <a href="#" class="hover:underline">Add Student</a>
                    <a href="#" class="hover:underline">Add Teacher</a>
                    <a href="#" class="hover:underline">Add Class</a>
                @endif
                
                @if(Auth::user()->user_type !== 'admin')
                    <a href="#" class="hover:underline">Schedule</a>
                @endif
                
                
                @if(Auth::user()->user_type === 'student')
                    <a href="#" class="hover:underline">Ledger</a>
                    <a href="#" class="hover:underline">Absences</a>
                @endif

                @if(Auth::user()->user_type === 'teacher')
                    <a href="#" class="hover:underline">Attendance</a>
                @endif
                
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="hover:underline">Logout</button>
                </form>
            </div>
        </div>
    </nav>

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
                    <th class="border p-2">Username</th>
                    <th class="border p-2">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($students as $student)
                    <tr>
                        <td class="border p-2">{{ $student->name }}</td>
                        <td class="border p-2">{{ $student->email }}</td>
                        <td class="border p-2">{{ $student->username }}</td>
                        <td class="border p-2">
                            <form action="{{ route('admin.approve.student', $student->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">
                                    Approve
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center p-4">No unenrolled students found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</body>
</html>
