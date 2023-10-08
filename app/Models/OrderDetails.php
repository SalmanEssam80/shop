<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    use HasFactory;
    protected $gaurded = ['id'];

    public function order(){
        return $this->belongsTo(order::class);
    }

    public function product(){
        return $this->belongsTo(product::class);
    }
}
