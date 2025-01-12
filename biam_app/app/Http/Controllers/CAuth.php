<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CAuth extends Controller {
    public function ViewForm() { return view('auth.index'); }
    
    // Submit the Fomr
    public function SubmitForm(Request $request) {
        $validator = Validator::make($request->all(), [
            'username' => 'required|unique',
            'password' => 'required|string|min:8'
        ]);

    $user = new User();

    // Assign form data to the model attributes
    $user->username       = $request->input('username');   // Corrected method to retrieve input
    $user->password       = Hash::make($request->input('password')); // Hash password
    $user->email          = 'emsss@gmailo.com';  // You can replace this with dynamic input if needed
    $user->phone          = '01799729507';   // You can replace this with dynamic input if needed
    $user->role           = 'undefined';      // Default role, can be dynamic
    $user->remember_token = 'unsent';         // Default remember token, can be dynamic

    // Save the user to the database
    $res = $user->save();
    
    if($res){
        return back()->with('success','Submitted OK');
    } else {
        return back()->with('failed');
    }

    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('LoginForm'); 
    }
}
