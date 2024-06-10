<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'first_name', 'last_name', 'email', 'phone', 'company', 'position'];

    protected $hidden = ['id', 'password','created_at', 'updated_at', 'deleted_at'];
}
