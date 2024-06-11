<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AssetPurchaseOrder extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['supplier_id', 'order_date', 'delivery_date', 'status', 'total_amount', 'remarks'];

    protected $hidden = ['id', 'password','created_at', 'updated_at', 'deleted_at'];
}
