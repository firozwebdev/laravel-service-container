<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lesson extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['module_id', 'title', 'content', 'video_url', 'order'];

    protected $hidden = ['id', 'password','created_at', 'updated_at', 'deleted_at'];
}
