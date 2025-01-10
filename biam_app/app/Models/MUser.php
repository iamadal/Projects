<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\L;

class MUser extends Model
{
    use HasFactory;

    protected $table = 'auth'; 
    protected $fillable = [
        'username',
        'password',
        'email',
        'phone',
        'role',
    ];
    protected $hidden = ['password','remember_token'];
}




public function readStrem($name, $app = '1', $switch){
       if($name)-><
}