<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $gaurded = ['id'];

    public function product_category() {
        return $this->hasMany(ProductCategory::class);
    }
}
