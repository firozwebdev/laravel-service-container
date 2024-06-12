<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Submission extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['assignment_id', 'student_id', 'submitted_at', 'file_url', 'grade', 'feedback'];

    protected $hidden = ['id', 'password','created_at', 'updated_at', 'deleted_at'];
}
