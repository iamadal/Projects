<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Pages extends Controller {
    public function index() {
        return view('auth.index');
    }

    public function dashboard(){
        return view('dashboard.dashboard');
    }
}


