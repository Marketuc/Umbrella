<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | Umbrella Academy</title>
    @vite(['resources/css/app.css', 'resources/js/app.js']) <!-- Breeze default styles -->
</head>
<body class="bg-cover bg-center min-h-screen flex items-center justify-center" 
    style="background-image: url('{{ asset('storage/schoolbackground.png') }}');">

    <div class="bg-white p-10 rounded-lg shadow-xl w-full max-w-2xl">
        <div class="flex justify-center mb-4">
            <img src="{{ asset('storage/schoollogo.jpg') }}" alt="School Logo" class="h-16">
        </div>

        <h2 class="text-center text-2xl font-bold text-gray-800 mb-6">Umbrella Academy</h2>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email Address')" />
                <x-text-input id="email" class="block mt-1 w-full border-gray-300 rounded-lg p-3" 
                    type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="block mt-1 w-full border-gray-300 rounded-lg p-3"
                    type="password" name="password" required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="flex items-center justify-between mt-4">
                <label for="remember_me" class="flex items-center">
                    <input id="remember_me" type="checkbox" 
                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot password?') }}
                    </a>
                @endif
            </div>

            <!-- Login Button -->
            <div class="mt-6 flex justify-between items-center">
                <a class="text-sm text-gray-600 hover:text-gray-900" href="{{ route('register') }}">
                    {{ __('Don’t have an account? Register') }}
                </a>

                <x-primary-button class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2 rounded-lg">
                    {{ __('Log in') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</body>
</html>
