<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AssetCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [];

    protected $hidden = ['id', 'password','created_at', 'updated_at', 'deleted_at'];
}
