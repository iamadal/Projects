<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller {
    
    public function create() {
        return view('users.create');
    }

    public function register(Request $request) {
        // Validate the request data with custom messages
        $request->validate([
            'username' => 'required|unique:users|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
            'phone' => 'required|regex:/^\+?[0-9]{10,15}$/',
            'country' => 'required',
            'fullname' => 'required',
            'gender' => 'required',
            'dob' => 'required|date',
        ], [
            'username.required' => 'The username is required.',
            'username.unique' => 'This username has already been taken.',
            'username.max' => 'The username cannot be longer than 255 characters.',
            'email.required' => 'The email address is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email is already registered.',
            'password.required' => 'The password is required.',
            'password.min' => 'The password must be at least 8 characters.',
            'password.confirmed' => 'The password confirmation does not match.',
            'phone.required' => 'The phone number is required.',
            'phone.regex' => 'The phone number format is invalid. Please use a valid number.',
            'country.required' => 'Please select a country.',
            'fullname.required' => 'Please provide your full name.',
            'gender.required' => 'Please select your gender.',
            'dob.required' => 'Please provide your date of birth.',
            'dob.date' => 'Please provide a valid date of birth.',
        ]);

        try {
            // Create the user and hash the password
            $user = User::create([
                'username' => trim($request->input('username')), // Trimmed input
                'email' => $request->input('email'),
                'password' => Hash::make(trim($request->input('password'))), // Trimmed input for password and hashed
                'phone' => $request->input('phone'),
                'country' => $request->input('country'),
                'name' => $request->input('fullname'),
                'gender' => $request->input('gender'),
                'dob' => $request->input('dob'),
                'rating' => 0,
                'status' => 'inactive',
                'verified' => 'no'
            ]);

            return redirect()->route('users.create')->with('success', 'User created successfully!');
        } catch (\Exception $e) {
            return redirect()->route('users.create')->with('error', 'There was an issue creating the user. Please try again.');
        }
    }

    public function password_reset() {
        return view('users.password_reset');
    }

    public function password_reset_post() {
        return "Submitted";
    }

    public function UserHome() {
        return view('users.dashboard');
    }

    /*------------------------------------------------------------*/
    public function login(Request $request) {
        // Validate login input with custom messages
        $info = $request->validate([
            'user' => 'required',
            'pass' => 'required'
        ], [
            'user.required' => 'The username or email is required.',
            'pass.required' => 'The password is required.'
        ]);


        // Retrieve the user based on username or email
        $user = User::where('username', $info['user'])->first();
     
        if($user) {
            if(Hash::check($info['pass'], $user->password)) {
                Auth::login($user);
                session([
                    'role'  => 'user',
                    'email' => $user['email'],
                    'name'  => $user['name'],
                    'phone' => $user['phone']
                ]);
                return redirect()->route('dashboard')->with('success', 'Login successful!');
            } else {
                return redirect()->route('app_login_view')->with('error', 'Invalid credentials');
            }
        } else {
                return redirect()->route('app_login_view')->with('error', 'User not Found');
        }
    }

    public function logout(Request $request) {
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        session()->forget('role');
        return redirect()->route('app_root')->with('success','Logged Out');
    }
}
