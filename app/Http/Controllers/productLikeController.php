<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;

class productLikeController extends Controller
{
    public function like($id) {
        Like::firstOrCreate([
            'user_id' => auth()->id(),
            'product_id' => $id
        ]);
        return redirect()->back()->with('message','your like added');
    }
}
