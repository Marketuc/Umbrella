<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Edit Teacher | Umbrella Academy</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen">
    @include('layouts.nav')

    <div class="container mx-auto mt-8 p-6 bg-white rounded shadow-md max-w-lg">
        <h2 class="text-2xl font-bold mb-6">Edit Teacher</h2>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.update.teacher', $teacher->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label for="name" class="block font-semibold mb-1">Name</label>
                <input type="text" id="name" name="name" value="{{ old('name', $teacher->name) }}" class="w-full border border-gray-300 rounded px-3 py-2" required />
                @error('name') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="email" class="block font-semibold mb-1">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', $teacher->email) }}" class="w-full border border-gray-300 rounded px-3 py-2" required />
                @error('email') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="program" class="block font-semibold mb-1">Program / Department</label>
                <input type="text" id="program" name="program" value="{{ old('program', $teacher->program) }}" class="w-full border border-gray-300 rounded px-3 py-2" />
                @error('program') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="phone" class="block font-semibold mb-1">Phone</label>
                <input type="text" id="phone" name="phone" value="{{ old('phone', $teacher->phone) }}" class="w-full border border-gray-300 rounded px-3 py-2" />
                @error('phone') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="photo" class="block font-semibold mb-1">Photo</label>
                @if($teacher->photo)
                    <img src="{{ asset('storage/' . $teacher->photo) }}" alt="Current Photo" class="mb-2 h-24 rounded-full" />
                @endif
                <input type="file" id="photo" name="photo" accept="image/*" class="w-full" />
                @error('photo') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex justify-between items-center">
                <a href="{{ route('admin.view.teachers') }}" class="text-gray-600 hover:underline">Cancel</a>
                <button type="submit" class="bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700">Update Teacher</button>
            </div>
        </form>
    </div>
</body>
</html>
