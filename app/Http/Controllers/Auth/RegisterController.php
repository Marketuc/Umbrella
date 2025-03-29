<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Storage;
use App\Providers\RouteServiceProvider;
class RegisterController extends Controller
{
    public function show()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->merge(['user_type' => $request->user_type ?? 'student']);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'dob' => 'required|date',
            'gender' => 'required|in:male,female,other',
            'phone' => 'required|string|max:15',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'user_type' => 'in:admin,teacher,student',
        ]);
    
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        // Handle profile photo upload
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('profile-photos', 'public');
        }

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'dob' => $request->dob,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'photo' => $photoPath,
            'password' => Hash::make($request->password),
            'user_type' => $request->user_type,
        ]);

        Auth::login($user);

        return redirect()->route('dashboard')->with('success', 'Registration successful!');
    }
}