<?php

namespace App\Livewire\Admin;

use App\Models\Subscriber;
use Livewire\Component;
use Livewire\WithPagination;

class Subscribers extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function delete($id) {
        Subscriber::find($id)->delete();
    }

    public function render()
    {
        return view('livewire.admin.subscribers',[
            'subscribers' => Subscriber::latest()->paginate(10),
        ])->layout('admin.layouts.wire_app');
    }
}
