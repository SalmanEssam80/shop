<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;
    protected $gaurded = ['id'];

    public function product_option()
    {
        return $this->hasMany(ProductOption::class);
    }
}
