<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\Route;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
{
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'dob' => ['nullable', 'date'],
        'gender' => ['nullable', 'in:male,female,other'],
        'username' => ['required', 'string', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
        'phone' => ['required', 'string', 'max:20'],
        'photo' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        'user_type' => ['required', 'in:admin,teacher,student'],
        'program' => ['required', 'string', 'max:255'],
    ]);

    // Handle photo upload
    $photoPath = null;
    if ($request->hasFile('photo')) {
        $photoPath = $request->file('photo')->store('profile_photos', 'public');
    }

    // Create user
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'dob' => $request->dob,
        'gender' => $request->gender,
        'username' => $request->username,
        'password' => Hash::make($request->password),
        'phone' => $request->phone,
        'photo' => $photoPath,
        'user_type' => $request->user_type,
        'program' => $request->program,
    ]);

    Auth::login($user);

    return redirect('/dashboard');
}
}
