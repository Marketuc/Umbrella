<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Our School</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="h-screen  bg-cover bg-center" style="background-image: url('{{ asset('storage/schoolbg.png') }}');">

    <!-- Overlay -->
    <div class="h-full w-full bg-black bg-opacity-50 flex flex-col justify-center items-center text-center px-4">
        
        <!-- School Name -->
        <h1 class="text-white text-5xl font-bold mb-4 drop-shadow-lg">Welcome to The Umbrella Academy</h1>
        <p class="text-white text-lg max-w-2xl mb-6 drop-shadow-lg">
            A place where knowledge, creativity, and innovation come together. Join us on a journey of excellence!
        </p>

        <!-- Buttons -->
        <div class="space-x-4">
            <a href="{{ route('login') }}" class="px-6 py-3 bg-blue-600 text-white rounded-lg shadow-lg hover:bg-blue-700 transition">Login</a>
            <a href="{{ route('register') }}" class="px-6 py-3 bg-green-600 text-white rounded-lg shadow-lg hover:bg-green-700 transition">Register</a>
        </div>
    </div>

</body>
</html>
