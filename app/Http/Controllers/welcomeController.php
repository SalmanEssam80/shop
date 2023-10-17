<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class welcomeController extends Controller
{
    public function welcome()
    {
        return view('welcome', [
            'categories' => Category::all()
        ]);
    }

    public function show_searched_items($item)
    {
        $products = Product::where('id', $item)->orWhere('name', 'LIKE', '%' . $item . '%')->orWhere('weight', $item)->orWhere('description', 'LIKE', '%' . $item . '%')->orWhere('price', $item)->get();
        return view('search',[
            'products' => $products,
            'searchItem' => $item
        ]);
    }

    public function show_searched_item_by_category($id)
    {
        $products = Product::where('category_id', $id)->get();
        return view('search', [
            'products' => $products,
            'searchItem' => $id
        ]);
    }

    public function show_searched_item_by_name($name)
    {
        $product = Product::where('name', $name)->orWhere('description', 'like', '%' . $name . '%')->latest()->paginate(9);
        return view('search', [
            'products' => $product,
            'searchItem' => $name
        ]);
    }
}
