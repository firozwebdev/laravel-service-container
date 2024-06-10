<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['category_id', 'title', 'post_status', 'description'];

    protected $hidden = ['id', 'password','created_at', 'updated_at', 'deleted_at'];
}
