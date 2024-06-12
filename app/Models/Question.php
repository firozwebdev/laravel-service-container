<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['exam_id', 'question_text', 'question_type', 'marks'];

    protected $hidden = ['id', 'password','created_at', 'updated_at', 'deleted_at'];
}
