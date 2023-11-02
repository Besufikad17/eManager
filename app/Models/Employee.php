<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model {
    use HasFactory;

    protected $fillable = [
        'fname',
        'lname',
        'profile_picture_url',
        'email',
        'phonenumber',
        'dept',
        'date_of_birth',
        'salary',
        'gender'
    ];
}
