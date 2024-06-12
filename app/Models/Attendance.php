<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attendance extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['student_id', 'class_id', 'date', 'status'];

    protected $hidden = ['id', 'password','created_at', 'updated_at', 'deleted_at'];
}
