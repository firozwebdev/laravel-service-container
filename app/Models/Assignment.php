<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Assignment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['course_id', 'title', 'description', 'due_date'];

    protected $hidden = ['id', 'password','created_at', 'updated_at', 'deleted_at'];
}
