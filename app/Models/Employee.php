<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['first_name', 'last_name', 'email', 'phone', 'address', 'position', 'salary', 'hire_date', 'status'];

    protected $hidden = ['id', 'password','created_at', 'updated_at', 'deleted_at'];
}
