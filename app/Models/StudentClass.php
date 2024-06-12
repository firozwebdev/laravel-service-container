<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentClass extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['course_id', 'faculty_id', 'semester', 'year'];

    protected $hidden = ['id', 'password','created_at', 'updated_at', 'deleted_at'];
}
