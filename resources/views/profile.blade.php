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

    <!-- Profile Content -->
    <div class="container mx-auto mt-8 p-6 bg-white shadow-md rounded-lg">
        <h2 class="text-2xl font-bold text-gray-800">Profile</h2>
        <div class="mt-4 space-y-2">
            <p><strong>Name:</strong> <span class="text-gray-700">{{ $user->name }}</span></p>
            <p><strong>Email:</strong> <span class="text-gray-700">{{ $user->email }}</span></p>
            <p><strong>Username:</strong> <span class="text-gray-700">{{ $user->username }}</span></p>
            <p><strong>Date of Birth:</strong> <span class="text-gray-700">{{ $user->dob->format('Y-m-d') }}</span></p>
            <p><strong>Phone:</strong> <span class="text-gray-700">{{ $user->phone }}</span></p>
            <p><strong>User Type:</strong> 
                <span class="font-semibold text-[#001F3F]"> <!-- Deep Navy Blue -->
                    {{ ucfirst($user->user_type) }}
                </span>
            </p>
            @if(Auth::user()->user_type === 'teacher' && $user->program)
            <p><strong>Department:</strong> <span class="text-gray-700">{{ $user->program }}</span></p>
            @endif
            @if(Auth::user()->user_type === 'student' && $user->program)
            <p><strong>Program:</strong> <span class="text-gray-700">{{ $user->program }}</span></p>
            @endif
            @if(Auth::user()->user_type === 'student' && $user->program)
            <p><strong>Enrollment:</strong> 
    <span class="text-gray-700">
        {{ $user->enrolled ? 'Enrolled' : 'Not yet Enrolled, Visit the Office to officially enroll' }}
    </span>
    @endif
</p>
        </div>
    </div>

</body>
</html>
