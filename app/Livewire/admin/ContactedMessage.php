<?php

namespace App\Livewire\Admin;

use App\Models\ContactUs;
use Livewire\Component;
use Livewire\WithPagination;

class ContactedMessage extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;

    public function render()
    {
        return view('livewire.admin.contacted-message',[
            'clients' => ContactUs::where('name','LIKE','%'.$this->search.'%')->latest()->paginate(10)
        ])->layout('admin.layouts.wire_app');
    }
}
