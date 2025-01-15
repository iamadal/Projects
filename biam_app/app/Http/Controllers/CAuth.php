<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\Models\User;

class CAuth extends Controller {
    // View The Login form
    public function ViewForm() { return view('auth.index'); }
    
    // Submit the login form
    public function SubmitForm(Request $request) {
         $request->validate([
            'usernmae' => 'unique',
            'password' => 'required|min:8'
        ],
            [
                'password.required' => 'অনুগ্রহ করে ইউজার আইডি ও পাসওয়ার্ড লিখুন।',
                'password.min' => 'পাসওয়ার্ড  ৮ অক্ষরের ডিজিটের বেশি হতে হবে।' 

            ]
         );

         $user = User::where('username',$request->username)->first();

         if($user && Hash::check($request->password, $user->password)){
            Auth::login($user,$request->has('remember'));
            return redirect()->intended(route('dashboard'));
         } 

         return back()->withErrors(['username' => 'আপনার পাসওয়ার্ড অথবা ইউজার আইডি সঠিক নয়!']);
        
    }

    public function logout(Request $request) {
        Auth::logout();
        return redirect()->route('LoginForm'); 
    }
}
