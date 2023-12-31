<?php

namespace App\Livewire;

use App\Models\Subscriber;
use Livewire\Component;

class Subscribe extends Component
{
    public $email;

    public function add_subscriber()
    {
        $this->validate([
            'email' => 'required|email|unique:subscribers,email,except,id'
        ]);
        Subscriber::create([
            'email' => $this->email
        ]);
        $this->email = "";
        session()->flash('message', 'Email Added Successfully');
    }

    public function render()
    {
        return view('livewire.subscribe');
    }
}
