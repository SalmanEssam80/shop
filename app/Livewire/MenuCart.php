<?php

namespace App\Livewire;

use App\Models\Cart;
use Livewire\Component;

class MenuCart extends Component
{
    public function render()
    {
        return view('livewire.menu-cart',[
            'products' => Cart::where('user_id',auth()->id())->get('product_id')
        ]);
    }
}
