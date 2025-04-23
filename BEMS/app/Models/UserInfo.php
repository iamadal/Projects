<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    protected $table = 'user_info';
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'bemsId', 'first_name', 'last_name', 'designation', 'grade', 'joining_date', 
        'dre', 'joining_letter_url', 'prl', 'nid', 'phone', 'el', 'last_degree', 
        'img_url', 'extra', 'created_at', 'updated_at'
    ];

    protected $casts = [
        'joining_date' => 'date',
        'dre' => 'date',
        'prl' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public $timestamps = true;
}
