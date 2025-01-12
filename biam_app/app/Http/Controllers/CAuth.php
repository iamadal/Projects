<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\Models\User;

class CAuth extends Controller {
    public function ViewForm() { return view('auth.index'); }
    
    // Submit the Fomr
    public function SubmitForm(Request $request) {
        
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('LoginForm'); 
    }
}
