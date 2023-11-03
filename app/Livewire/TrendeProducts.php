<?php

namespace App\Livewire;

use App\Models\Like;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class TrendeProducts extends Component
{
    public function render()
    {
        $trendeProducts = Like::select('product_id', DB::raw('count(product_id) as counts'))->groupBy('product_id')->latest()->where('created_at', '>=', now()->subMonth())->take(6)->get();
        return view('livewire.trende-products',[
            'trendeProducts' => $trendeProducts
        ]);
    }
}
