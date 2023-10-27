<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function like(){
        return $this->hasMany(Like::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function order_details(){
        return $this->hasMany(order_details::class);
    }

    public function cart() {
        return $this->hasMany(Cart::class);
    }
}
