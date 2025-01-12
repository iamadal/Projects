<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\MUser; // This will Extend the Model class so all methods are available
class Pages extends Controller {
    public function dashboard(){
        return view('dashboard.dashboard');
    }
}


