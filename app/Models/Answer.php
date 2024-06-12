<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Answer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['exam_submission_id', 'question_id', 'answer_text', 'marks_obtained'];

    protected $hidden = ['id', 'password','created_at', 'updated_at', 'deleted_at'];
}
