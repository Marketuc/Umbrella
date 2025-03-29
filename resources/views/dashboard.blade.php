<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard | Umbrella Academy</title>
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
                    <a href="{{ route('admin.unenrolled.students') }}" class="hover:underline">Add Student</a>
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

  <!-- Dashboard Content -->
<div class="container mx-auto mt-8 p-6 bg-white shadow-md rounded-lg">
    <h2 class="text-2xl font-bold text-gray-800">Welcome, {{ Auth::user()->name }}!</h2>
    
    <p class="mt-2 text-gray-600">
        You are logged in as 
        <span class="font-semibold text-[#001F3F]"> <!-- Deep Navy Blue -->
            {{ ucfirst(Auth::user()->user_type) }}
        </span>.
    </p>

    <!-- Role-based content -->
    <div class="mt-6">
        @if(Auth::user()->user_type === 'admin')
            <h3 class="text-xl font-semibold">Admin Panel</h3>
            <p class="text-gray-600">Manage users, teachers, and students.</p>
            <ul class="list-disc list-inside text-gray-600 mt-2">
                <li><a href="#" class="text-blue-600 hover:underline">View All Users</a></li>
                <li><a href="#" class="text-blue-600 hover:underline">Manage Subjects</a></li>
                <li><a href="#" class="text-blue-600 hover:underline">School Announcements</a></li>
            </ul>

        @elseif(Auth::user()->user_type === 'teacher')
            <h3 class="text-xl font-semibold">Teacher Dashboard</h3>
            <p class="text-gray-600">Manage your classes and students.</p>
            <ul class="list-disc list-inside text-gray-600 mt-2">
                <li><a href="#" class="text-blue-600 hover:underline">My Schedule</a></li>
                <li><a href="#" class="text-blue-600 hover:underline">Assigned Subjects</a></li>
                <li><a href="#" class="text-blue-600 hover:underline">Student Attendance</a></li>
            </ul>

        @else
            <h3 class="text-xl font-semibold">Student Dashboard</h3>
            <p class="text-gray-600">Access your lessons and assignments.</p>
            <ul class="list-disc list-inside text-gray-600 mt-2">
                <li><a href="#" class="text-blue-600 hover:underline">My Class Schedule</a></li>
                <li><a href="#" class="text-blue-600 hover:underline">View Grades</a></li>
                <li><a href="#" class="text-blue-600 hover:underline">Download Assignments</a></li>
            </ul>
        @endif
    </div>

    <!-- Recent Announcements -->
    <div class="mt-8 bg-gray-50 p-4 rounded-lg shadow">
        <h3 class="text-lg font-semibold text-gray-800">Latest Announcements</h3>
        <p class="text-gray-600 mt-2">Stay updated with the latest news from Umbrella Academy.</p>
        <ul class="list-disc list-inside text-gray-600 mt-2">
            <li><a href="#" class="text-blue-600 hover:underline">Upcoming School Events</a></li>
            <li><a href="#" class="text-blue-600 hover:underline">New Policies for the Semester</a></li>
            <li><a href="#" class="text-blue-600 hover:underline">Exam Schedule Released</a></li>
        </ul>
    </div>
</div>



    </div>
</body>
</html>