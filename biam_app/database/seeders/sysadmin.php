<?php

/**
 * @author Adal Khan
 * */

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class sysadmin extends Seeder
{
    public function run(): void
    {
       User::create([
        'username'           => 'admin',
        'password'           =>  Hash::make('55761910'),
           'email'           => 'mdadalkhan@gmail.com',
           'phone'           => '01799729507',
            'role'           => 'sysadmin',
            'remember_token' => 'admin'
    ]);   
    }
}
