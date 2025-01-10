<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\Models\MUser;
use App\Http\Controllers\Controllers;

class CAuth extends Controller {

    private $err = '';

    public function ViewForm() {
        return view('auth.index');
    }

    public function SubmitForm(Request $request){
        $validate = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);
        
        $uc = MUser::where('username', $request->username)->first();
         if ($uc && Hash::check($request->password, $uc->password)) {
            
            Auth::login($uc);
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }



        return back()->withErrors(['username' => 'invalid username or password']);
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
