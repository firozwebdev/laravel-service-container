<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transport extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['vehicle_number', 'driver_name', 'route', 'capacity'];

    protected $hidden = ['id', 'password','created_at', 'updated_at', 'deleted_at'];
}
