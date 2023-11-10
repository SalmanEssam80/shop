<?php

namespace App\Livewire;

use App\Models\Cart as ModelsCart;
use Livewire\Component;

class Cart extends Component
{
    public $total;
    
    public function delete($id){
        ModelsCart::find($id)->delete();
    }

    public function render()
    {
        return view('livewire.cart',[
            'products' => ModelsCart::where('user_id',auth()->id())->get()
        ]);
    }
}
