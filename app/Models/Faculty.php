<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Faculty extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['user_id', 'first_name', 'last_name', 'dob', 'gender', 'address', 'city', 'state', 'zip_code', 'hire_date', 'department_id', 'designation'];

    protected $hidden = ['id', 'password','created_at', 'updated_at', 'deleted_at'];
}
