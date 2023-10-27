<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Like;
use App\Models\User;
use Illuminate\Http\Request;

class AdminHelperController extends Controller
{
    public function showSingleCustomer($id)
    {
        return view('admin.user_details',[
            'customer' => User::find($id)->first(),
            'likes' => Like::where('user_id',$id)->get(),
            'cartProducts' => Cart::where('user_id',$id)->get(),
        ]);
    }

    public function manage_aboutUs_page()
    {
        return view('admin.aboutUs');
    }

    public function store(Request $request)
    {
        dd($request->all());
    }
}
