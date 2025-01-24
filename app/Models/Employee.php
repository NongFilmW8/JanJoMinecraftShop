<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'birth_date',
        'hire_date',
        'emp_no',
        'gender',
        'profile_image',
    ];
}
