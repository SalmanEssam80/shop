<?php

namespace App\Livewire;

use Livewire\Component;

class Checkout extends Component
{
    public function render()
    {
        return view('livewire.checkout',[
            'products' => cart::where('user_id',auth()->id())->get()
        ]);
    }
}
