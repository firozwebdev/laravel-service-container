<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'description', 'credits', 'department_id', 'program_id'];

    protected $hidden = ['id', 'password','created_at', 'updated_at', 'deleted_at'];
}
