<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['fee_id', 'amount', 'payment_date', 'payment_method'];

    protected $hidden = ['id', 'password','created_at', 'updated_at', 'deleted_at'];
}
