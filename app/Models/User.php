<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['username', 'email', 'password', 'role'];

    protected $hidden = ['id', 'password','created_at', 'updated_at', 'deleted_at'];
}
