<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AssetDepreciation extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['asset_id', 'depreciation_date', 'depreciation_amount', 'description'];

    protected $hidden = ['id', 'password','created_at', 'updated_at', 'deleted_at'];
}
