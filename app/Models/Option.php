<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Option extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['question_id', 'option_text', 'is_correct'];

    protected $hidden = ['id', 'password','created_at', 'updated_at', 'deleted_at'];
}
