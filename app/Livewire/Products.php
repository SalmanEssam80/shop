<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class Products extends Component
{
    public function product_liked($id)
    {
        dd($id);
    }
    
    public function render()
    {
        return view('livewire.products',['products' => Product::all()]);
    }
}
