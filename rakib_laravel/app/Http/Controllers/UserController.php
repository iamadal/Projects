<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;

class UserController extends Controller {
    
    // Show the form to create a new user (Create)
    public function create() {
        return view('users.create');
    }
    // Handle user registration (Store - Create)
    public function register(Request $request) {
        // Validation
        
        $request->validate([
            'username' => 'required|unique:users|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
            'phone' => 'required|regex:/^\+?[0-9]{10,15}$/', // Phone validation
            'country' => 'required',
            'fullname' => 'required',
            'gender' => 'required',
            'dob' => 'required|date',
        ], [
            // Custom error messages
            'username.required' => 'Please enter a username.',
            'username.unique' => 'This username is already taken.',
            'email.required' => 'Please enter a valid email address.',
            'email.email' => 'Please enter a valid email address.',
            'password.required' => 'Password is required.',
            'password.min' => 'Password must be at least 8 characters.',
            'password.confirmed' => 'Password confirmation does not match.',
            'phone.required' => 'Please enter your phone number.',
            'phone.regex' => 'Phone number must be between 10 and 15 digits and may start with a +.',
            'country.required' => 'Please select your country.',
            'fullname.required' => 'Please enter your full name.',
            'gender.required' => 'Please select your gender.',
            'dob.required' => 'Please select your date of birth.',
            'dob.date' => 'Please enter a valid date.',
        ]);
        
        // Create a new user if validation passes
        try {
            $user = Users::create([
                'username' => $request->input('username'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),
                'phone' => $request->input('phone'),
                'country' => $request->input('country'),
                'name' => $request->input('fullname'),
                'gender' => $request->input('gender'),
                'dob' => $request->input('dob'),
                'rating' => 0,
                'status' => 'inactive',
                'verified' => 'no'
            ]);

            // Redirect back with success message
            return redirect()->route('users.create')->with('success', 'User created successfully!');
        } catch (\Exception $e) {
            // If something goes wrong, return with an error message
            return redirect()->route('users.create')->with('error', 'There was an issue creating the user. Please try again.');
        }
    }

    /* CRUD */

    // Display all users (Read - Index)
    public function index() {
        $users = Users::all(); // Get all users from the database
        return view('users.index', compact('users')); // Pass the users to the view
    }

    // Show the form to edit a specific user (Update - Edit)
    public function edit($id) {
        $user = Users::findOrFail($id); // Find the user by ID
        return view('users.edit', compact('user')); // Pass the user to the edit view
    }

    // Handle updating a user's information (Update - Update)
    public function update(Request $request, $id) {
        // Validation
        $request->validate([
            'username' => 'required|max:255|unique:users,username,' . $id, // Ignore unique check for the current user
            'email' => 'required|email|unique:users,email,' . $id, // Ignore unique check for the current user
            'phone' => 'required|regex:/^\+?[0-9]{10,15}$/', // Phone validation
            'country' => 'required',
            'name' => 'required',
            'gender' => 'required',
            'dob' => 'required|date',
        ]);

        try {
            $user = Users::findOrFail($id); // Find the user by ID

            // Update user data
            $user->update([
                'username' => $request->username,
                'email' => $request->email,
                'phone' => $request->phone,
                'country' => $request->country,
                'name' => $request->name,
                'gender' => $request->gender,
                'dob' => $request->dob
            ]);

            // Redirect with success message
            return redirect()->route('users.index')->with('success', 'User updated successfully!');
        } catch (\Exception $e) {
            // Return with error message
            return redirect()->route('users.index')->with('error', 'There was an issue updating the user. Please try again.');
        }
    }

    // Handle deleting a user (Delete)
    public function destroy($id) {
        try {
            $user = Users::findOrFail($id); // Find the user by ID
            $user->delete(); // Delete the user from the database

            // Redirect with success message
            return redirect()->route('users.index')->with('success', 'User deleted successfully!');
        } catch (\Exception $e) {
            // Return with error message
            return redirect()->route('users.index')->with('error', 'There was an issue deleting the user. Please try again.');
        }
    }

    public function password_reset(){
        return view('users.password_reset');
    }
}
