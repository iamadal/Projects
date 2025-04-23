<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\User; 
use App\Model\UserInfo;

class cAdmin extends Controller {
    public function getLogin() {
    if (Auth::check() || session('role') === 'xadmin') {
        return redirect()->route('admin_home');
    }

    return view('admin_login');
} 

    public function postLogin(Request $request) {
        $info = $request->validate([
            'email'     => 'required|email',
            'password'  => 'required|min:8'
        ], [
            'email.required'     => 'ইমেইল অথবা ইউজারনেম লিখুন।',
            'email.email'        => 'ইমেইল এড্রেস সঠিকভাবে লিখুন।',
            'password.required'  => 'পাসওয়ার্ড লিখুন।',
            'password.min'       => 'পাসওয়ার্ড অবশ্যই ৮ অক্ষরের বেশি হতে হবে।'
        ]);
          
          if (Auth::attempt($info)) {
            $request->session()->regenerate();
            session(['role' => 'bems_admin']);
            return redirect()->route('admin_home');
        }

        return back()->withErrors([
            'email' => 'দু:খিত! আবার চেষ্টা করুন।',
        ]);
    }

    public function home(){
       session(['tab' => 1]);
       return view('admin.bems',['tab_no' => session('tab')]);
    }
    /* Show All users*/

    public function user_list(){
       session(['tab' => 1]);
       return view('admin.bems',['tab_no' => session('tab')]);
    }

    /* Crerate new User*/
    public function create_new(){
       session(['tab' => 2]);
       return view('admin.bems', ['tab_no' => session('tab')]);
    }
    
     public function create_save(){
        echo('Save created info');
     }

    /*Editing/ Update*/
    public function edit($id) {
        echo('Editing is done' . $id);
    }
    public function edit_save($id) {
        echo('Editing is done and Saved' . $id);
    }
    /* DELETING */
    public function delete($id) {
        return  $id . " is to be accessed";
    }

    public function logout(Request $request) {
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        session()->forget('role');
        return redirect()->route('app_login')->with('success','Logged Out');
    } 
}
