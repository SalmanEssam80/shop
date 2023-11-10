<?php

namespace App\Livewire;

use Livewire\Component;

class MenuSearchBar extends Component
{
    public $search;

    public function searchBar()
    {
        return redirect()->route('show_searched_items',$this->search);
    }

    public function render()
    {
        return view('livewire.menu-search-bar');
    }
}
