<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['hostel_id', 'room_number', 'capacity', 'status'];

    protected $hidden = ['id', 'password','created_at', 'updated_at', 'deleted_at'];
}
