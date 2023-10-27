<?php

namespace App\Livewire\Admin;

use App\Models\Order;
use Livewire\Component;

class Orders extends Component
{
    public function delete($id)
    {
        Order::find($id)->delete();
    }

    public function render()
    {
        return view('livewire.admin.orders',[
            'orders' => Order::latest()->paginate(20)
        ])->layout('admin.layouts.wire_app');
    }
}
