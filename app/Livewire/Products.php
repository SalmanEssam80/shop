<?php

namespace App\Livewire;

use App\Models\Like;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Products extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function product_liked($id)
    {
        if (auth()->user()){
            Like::create([
                'user_id' => auth()->id(),
                'product_id' => $id
            ]);
        }
    }

    public function render()
    {
        return view('livewire.products',['products' => Product::all()]);
    }
}
