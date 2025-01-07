<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;




class CAuth extends Controller {
    public function ViewForm(){
        return view('auth.index');
    }
    public function SubmitForm(Request $request){
        $request->validate(['email'=>'required|email','password'=>'required']);
    }



    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}
