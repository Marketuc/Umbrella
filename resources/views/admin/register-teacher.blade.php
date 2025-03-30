<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Teacher | Umbrella Academy</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen">

@include('layouts.nav')

    <!-- Create Teacher Form -->
    <div class="container mx-auto mt-8 p-6 bg-white shadow-md rounded-lg">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Create New Teacher</h2>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
    <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

        <form action="{{ route('admin.store.teacher') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block font-medium">Name</label>
                    <input type="text" name="name" class="w-full p-2 border rounded" required>
                </div>
                <div>
                    <label class="block font-medium">Email</label>
                    <input type="email" name="email" class="w-full p-2 border rounded" required>
                </div>
                <div>
                    <label class="block font-medium">Username</label>
                    <input type="text" name="username" class="w-full p-2 border rounded" required>
                </div>
                <div>
                    <label class="block font-medium">Password</label>
                    <input type="password" name="password" class="w-full p-2 border rounded" required>
                </div>
                <div>
    <label class="block font-medium">Confirm Password</label>
    <input type="password" name="password_confirmation" class="w-full p-2 border rounded" required>
</div>
                <div>
                    <label class="block font-medium">Phone</label>
                    <input type="text" name="phone" class="w-full p-2 border rounded" required>
                </div>
                <div>
                    <label class="block font-medium">Date of Birth</label>
                    <input type="date" name="dob" class="w-full p-2 border rounded">
                </div>
                <div>
                    <label class="block font-medium">Gender</label>
                    <select name="gender" class="w-full p-2 border rounded">
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                <div>
                    <label class="block font-medium">Department</label>
                    <input type="text" name="program" class="w-full p-2 border rounded" required>
                </div>
                <div>
                    <label class="block font-medium">Photo</label>
                    <input type="file" name="photo" class="w-full p-2 border rounded" required>
                </div>
            </div>
            <input type="hidden" name="user_type" value="teacher">
            <div class="mt-4">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Create Teacher
                </button>
            </div>
        </form>
    </div>

</body>
</html>
