<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use App\Models\MUser;

class sysadmin extends Seeder
{
    public function run(): void
    {
       MUser::create([
        'username'   => 'admin',
        'password'   =>  Hash::make('55761910'),
           'email'   => 'mdadalkhan@gmail.com',
           'phone'   => '01799729507',
            'role'   => 'sysadmin'
    ]);   
    }
}
