<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register | Umbrella Academy</title>
    @vite(['resources/css/app.css', 'resources/js/app.js']) <!-- Breeze default styles -->

    @if ($errors->any())
    <div class="bg-red-500 text-white p-3">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


</head>
<body class="bg-cover bg-center min-h-screen flex items-center justify-center" 
    style="background-image: url('{{ asset('storage/schoolbackground.png') }}');">

    <div class="bg-white p-10 rounded-lg shadow-xl w-full max-w-2xl">
        <div class="flex justify-center mb-4">
            <img src="{{ asset('storage/schoollogo.jpg') }}" alt="School Logo" class="h-16">
        </div>

        <h2 class="text-center text-2xl font-bold text-gray-800 mb-6">Umbrella Academy</h2>

        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf
            <!-- Full Name -->
            <div>
                <x-input-label for="name" :value="__('Full Name')" />
                <x-text-input id="name" class="block mt-1 w-full border-gray-300 rounded-lg p-3" 
                    type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Username -->
            <div class="mt-4">
                <x-input-label for="username" :value="__('Username')" />
                <x-text-input id="username" class="block mt-1 w-full border-gray-300 rounded-lg p-3" 
                    type="text" name="username" :value="old('username')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('username')" class="mt-2" />
            </div>

                        <!-- Password -->
                        <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="block mt-1 w-full border-gray-300 rounded-lg p-3"
                    type="password" name="password" required />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full border-gray-300 rounded-lg p-3"
                    type="password" name="password_confirmation" required />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <!-- Email -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email Address')" />
                <x-text-input id="email" class="block mt-1 w-full border-gray-300 rounded-lg p-3" 
                    type="email" name="email" :value="old('email')" required />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Program -->
<div class="mt-4">
    <x-input-label for="program" :value="__('Program')" />
    <select id="program" name="program" class="block mt-1 w-full border-gray-300 rounded-lg p-3">
        <option value="">Select Program</option>
        <option value="BSIT" {{ old('program') == 'BSIT' ? 'selected' : '' }}>BSIT</option>
        <option value="BSCS" {{ old('program') == 'BSCS' ? 'selected' : '' }}>BSCS</option>
        <option value="BSCoE" {{ old('program') == 'BSCoE' ? 'selected' : '' }}>BSCoE</option>
    </select>
    <x-input-error :messages="$errors->get('program')" class="mt-2" />
</div>

            <!-- Date of Birth -->
            <div class="mt-4">
                <x-input-label for="dob" :value="__('Date of Birth')" />
                <x-text-input id="dob" class="block mt-1 w-full border-gray-300 rounded-lg p-3"
                    type="date" name="dob" :value="old('dob')" required />
                <x-input-error :messages="$errors->get('dob')" class="mt-2" />
            </div>

            <!-- Gender -->
            <div class="mt-4">
                <x-input-label for="gender" :value="__('Gender')" />
                <select id="gender" name="gender" class="block mt-1 w-full border-gray-300 rounded-lg p-3">
                    <option value="">Select Gender</option>
                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                    <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                </select>
                <x-input-error :messages="$errors->get('gender')" class="mt-2" />
            </div>

            <!-- Phone Number -->
            <div class="mt-4">
                <x-input-label for="phone" :value="__('Phone Number')" />
                <x-text-input id="phone" class="block mt-1 w-full border-gray-300 rounded-lg p-3"
                    type="text" name="phone" :value="old('phone')" required />
                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
            </div>

            <!-- Profile Photo -->
            <div class="mt-4">
                <x-input-label for="photo" :value="__('Profile Photo')" />
                <input id="photo" class="block mt-1 w-full border-gray-300 rounded-lg p-3"
                    type="file" name="photo" accept="image/*" />
                <x-input-error :messages="$errors->get('photo')" class="mt-2" />
            </div>

            <input type="hidden" name="user_type" value="student">

            <!-- Register Button -->
            <div class="flex items-center justify-between mt-4">
                <a class="text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-primary-button class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2 rounded-lg">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</body>
</html>
