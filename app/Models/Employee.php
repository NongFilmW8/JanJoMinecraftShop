<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'emp_no',
        'first_name',
        'last_name',
        'birth_date',
        'hire_date',
        'dept_no',
        'gender',
        'profile_picture',
    ];
}
