<?php

namespace App\Livewire;

use App\Models\ContactUs as ModelsContactUs;
use Livewire\Component;

class ContactUs extends Component
{
    public $name;
    public $subject;
    public $email;
    public $message;

    public function add_contact_us_request()
    {

        $this->validate([
            'name' => 'required',
            'subject' => 'required',
            'email' => 'required',
            'message' => 'required|email',
        ]);

        ModelsContactUs::create([
            'name'    =>  $this->name,
            'subject' =>  $this->subject,
            'email'   =>  $this->email,
            'message' =>  $this->message,
        ]);

        $this->name='';
        $this->subject='';
        $this->email='';
        $this->message='';

        session()->flash('success','');
    }

    public function render()
    {
        return view('livewire.contact-us');
    }
}
