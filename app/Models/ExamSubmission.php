<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExamSubmission extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['exam_id', 'student_id', 'submitted_at', 'total_marks'];

    protected $hidden = ['id', 'password','created_at', 'updated_at', 'deleted_at'];
}
