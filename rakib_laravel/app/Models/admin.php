<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable {
    protected $table      = 'admin';
    protected $primaryKey = 'id';

    protected $fillable = ['username', 'email' ,'password'];
    public $timestamps  = true;
}
