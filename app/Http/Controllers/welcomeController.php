<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use App\Models\Category;
use App\Models\Faq;
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

    public function show_single_product($id)
    {
        return view('show_single_product', [
            'product' => product::where('id', $id)->first()
        ]);
    }

    public function show_searched_items($item)
    {
        $products = Product::where('id', $item)->orWhere('name', 'LIKE', '%' . $item . '%')->orWhere('weight', $item)->orWhere('description', 'LIKE', '%' . $item . '%')->orWhere('price', $item)->with('category')->get();
        return view('searchItem', [
            'products' => $products,
            'searchedItem' => $item
        ]);
    }

    public function show_searched_item_by_category($id)
    {
        $category = Category::find($id)->first();
        return view('search', [
            'category' => $category
        ]);
    }

    public function faq()
    {
        return view('faq',[
            'faqs' => Faq::latest()->get()
        ]);
    }

    public function show_searched_item_by_name($name)
    {
        $product = Product::where('name', $name)->orWhere('description', 'like', '%' . $name . '%')->latest()->paginate(9);
        return view('searchItem', [
            'products' => $product,
            'searchedItem' => $name
        ]);
    }

    public function aboutUs()
    {
        return view('about',[
            'data' => AboutUs::latest()->first()
        ]);
    }
}
