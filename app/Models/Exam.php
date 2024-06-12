<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Exam extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'course_id', 'class_id', 'date', 'total_marks'];

    protected $hidden = ['id', 'password','created_at', 'updated_at', 'deleted_at'];
}
