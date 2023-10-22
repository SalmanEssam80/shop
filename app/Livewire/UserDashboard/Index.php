<?php

namespace App\Livewire\UserDashboard;

use App\Models\Cart;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.user-dashboard.index',[
            'products' => Cart::where('user_id',auth()->id())
        ]);
    }
}
