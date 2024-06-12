<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notification extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['user_id', 'message', 'is_read'];

    protected $hidden = ['id', 'password','created_at', 'updated_at', 'deleted_at'];
}
