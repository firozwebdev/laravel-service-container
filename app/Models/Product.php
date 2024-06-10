<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['user_id', 'name', 'product_image', 'description', 'price', 'stock', 'category_id'];

    protected $hidden = ['id', 'password','created_at', 'updated_at', 'deleted_at'];
}
