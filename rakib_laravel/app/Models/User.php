<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $table = 'users';
    protected $primaryKey = 'id';

    protected $fillable = [
        'username', 'email', 'password', 'phone', 'country', 
        'name', 'gender', 'dob', 'rating', 'status', 'verified', 
        'remember_token'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'dob' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected $hidden = [
        'password', 'remember_token', 'email_verified_at',
    ];

    public $timestamps = true;

    protected $unique = ['email', 'phone'];
}
