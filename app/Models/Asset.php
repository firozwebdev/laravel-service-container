<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Asset extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['asset_name', 'asset_type_id', 'serial_number', 'purchase_date', 'warranty_expiration_date', 'status', 'assigned_to', 'location', 'price', 'description'];

    protected $hidden = ['id', 'password','created_at', 'updated_at', 'deleted_at'];
}
