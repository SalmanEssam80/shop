<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store($id)
    {
        Cart::create([
            'user_id' => auth()->id(),
            'product_id' => $id
        ]);
        return redirect()->back();
    }

}
