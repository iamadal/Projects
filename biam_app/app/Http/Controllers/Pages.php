<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\MUser; // This will Extend the Model class so all methods are available
class Pages extends Controller {
    public function dashboard(){
         MUser::firstOrCreate(
            [
            'username'=> 'admin', 
            'password'=>bcrypt('1234546'),
            'phone'=>'01799729507', 
            'first_name'=>'Adal', 
            'last_name'=>'Khan',
            'role'=>'admin'
        ]
    );

        return view('dashboard.dashboard');
    }
}


