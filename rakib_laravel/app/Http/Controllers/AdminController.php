<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\Admin;

class AdminController extends Controller {
   public function admin_home(Request $request) {
      if(session('role') == 'user') {
         $request->session()->invalidate();
         $request->session()->regenerateToken();
         session()->forget('role');
         return redirect()->route('app_root')->with('success', 'Logged Out');
      } else {
         return view('admin.home');
      }
   }

   public function admin_login(Request $request) {
      if(session('role') == 'user') {
         $request->session()->invalidate();
         $request->session()->regenerateToken();
         session()->forget('role');
         return redirect()->route('app_root')->with('success', 'Logged Out');
      } else {
         return view('admin.login');
      }
   }

     public function admin_login_submit(Request $request) {
      if(session('role') == 'user') {
         $request->session()->invalidate();
         $request->session()->regenerateToken();
         session()->forget('role');
         return redirect()->route('app_root')->with('success', 'Logged Out');
      } else {
           
        // Validate login input with custom messages
        $info = $request->validate([
            'user' => 'required',
            'pass' => 'required'
        ], [
            'user.required' => 'The username or email is required.',
            'pass.required' => 'The password is required.'
        ]);


        // Retrieve the user based on username or email
        $user = Admin::where('username', $info['user'])->first();
        if($user) {
            if(Hash::check($info['pass'], $user->password)) {
                Auth::login($user);
                session([
                    'role'  => 'admin',
                    'email' => $user['email'],
                    'name'  => $user['username'],
                ]);
                return redirect()->route('admin_home')->with('success', 'Login successful!');
            } else {
                return redirect()->route('admin_login')->with('error', 'Invalid credentials');
            }
        } else {
                return redirect()->route('admin_login')->with('error', 'Invalid credentials');
        }
      }
   }

}
