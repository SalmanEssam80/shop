<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class welcomeController extends Controller
{
    public function welcome(){
        return view('welcome',[
            'categories' => Category::all()
        ]);
    }

    public function show_category_products(){
        
    }
}
