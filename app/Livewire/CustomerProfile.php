<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class CustomerProfile extends Component
{
    public $photo;

    public function updatePhoto()
    {
        $current_user = User::find(auth()->id());
        if ($current_user->photo)
        {
            Storage::delete($current_user->photo);
        }
        $current_user->photo = $this->photo;
        $current_user->save();
        session()->flash('message' , 'Profile Update successfully. Prefresh Page.');
    }

    public function storeImage($photo)
    {
        if (!$photo) {
            return null;
        }
        $image   = $this->photo;
        $name  = Str::random() . '.jpg';
        Storage::disk('public')->put($name, $image);
        return 'storage/'.$name;
    }

    public function render()
    {
        return view('livewire.customer-profile');
    }
}
