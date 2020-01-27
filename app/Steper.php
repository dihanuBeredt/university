<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Steper extends Model
{
    protected $fillable = [
        'name', 'lname' , 'email', 'phone' , 'username' , 'password',
    ];
}
