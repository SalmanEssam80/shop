<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;
    protected $table = "product_categories";
    protected $guarded = ['id'];

    public function category()  {
        return $this->belongsTo(Category::class);
    }

    public function product()  {
        return $this->hasMany(Product::class);
    }
}
