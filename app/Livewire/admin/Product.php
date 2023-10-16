<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use App\Models\Product as ModelsProduct;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;

use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Product extends Component
{
    use WithFileUploads;
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $name;
    public $description;
    public $weight;
    public $stock;
    public $category;
    public $price;
    public $image;
    public $edit_image;
    public $thumbnail;
    public $edit_thumbnail;
    public $edit_product_id;
    public $button_text = "Add New Product";


    public function add_new_product()
    {
        if ($this->edit_image || $this->edit_thumbnail) {

            $this->update($this->edit_product_id);
        } else {
            $this->validate([
                'name' => 'required|max:50',
                'description' => 'required|max:255',
                'stock' => 'required|numeric',
                'price' => 'required|numeric',
                'weight' => 'required|numeric',
                'image' => 'required|image',
                'thumbnail' => 'required|image',
            ]);

            ModelsProduct::create([
                'name'        => $this->name,
                'weight'        => $this->weight,
                'barcode' =>        "00000",
                'description' => $this->description,
                'stock'       => $this->stock,
                'price'        => $this->price,
                'thumbnail'  => $this->storeImage($this->thumbnail),
                'image'  => $this->storeImage($this->image),
                'category_id' => $this->category,
            ]);

            // ProductCategory::create([
            //     'product_id' => $this->id,
            //     'category_id' => $this->category,
            // ]);

            $this->name = "";
            $this->description = "";
            $this->image = "";
            $this->thumbnail = "";
            $this->category = "";
            $this->price = "";
            $this->stock = "";
            $this->weight = "";

            session()->flash('message', 'Created successfully.');
        }
    }

    public function storeImage($thumbnail)
    {
        if (!$thumbnail) {
            return null;
        }
        $image   = $this->thumbnail;
        $name  = Str::random() . '.jpg';
        Storage::disk('public')->put($name, $image);
        return 'storage/' . $name;
    }

    public function edit($id)
    {
        $product = ModelsProduct::findOrFail($id);
        $this->edit_product_id = $id;
        $this->name = $product->name;
        $this->description = $product->description;
        $this->edit_image = $product->image;
        $this->price  = $product->price;
        $this->weight = $product->weight;
        $this->stock = $product->stock;
        $this->category = $product->category_id;
        $this->edit_thumbnail = $product->thumbnail;
        $this->button_text = "Update Product";
    }
    public function update($id)
    {
        $this->validate([
            'name' => 'required|max:50',
            'description' => 'required|max:255',
            'stock' => 'required|numeric',
            'weight' => 'required|numeric',
            'price' => 'required|numeric',
            'category' => 'required',
        ]);

        $product = ModelsProduct::findOrFail($id);
        $product->name = $this->name;
        $product->description = $this->description;
        $product->price = $this->price;
        $product->weight = $this->weight;
        $product->stock = $this->stock;
        $product->category_id = $this->category;

        if ($this->image) {
            $this->validate([
                'image' => 'image|max:3072',
            ]);
            Storage::delete($product->image);
            $product->image = $this->storeImage($this->image);
        }
        if ($this->thumbnail) {
            $this->validate([
                'image' => 'image|max:3072',
            ]);
            Storage::delete($product->thumbnail);
            $product->thumbnail = $this->storeImage($this->thumbnail);
        }
        $product->save();
        $this->name = "";
        $this->description = "";
        $this->edit_image="";
        $this->image = "";
        $this->thumbnail="";
        $this->category="";
        $this->price="";
        $this->stock="";
        $this->weight="";;
        $this->edit_thumbnail="";
        session()->flash('message', 'Updated Successfully.');
        $this->button_text = "Add New Product";
    }

    public function delete($id)
    {
        // ProductCategory::where('product_id' , $id)->delete();
        $product = ModelsProduct::findOrFail($id);
        if($product->thumbnail){
            Storage::delete($product->thumbnail);
        }
        if ($product->image) {
            Storage::delete($product->image);
        }
        $product->delete();
        session()->flash('message', 'Deleted Successfully.');
    }

    public function render()
    {
        return view('livewire.admin.product', [
            'products' => ModelsProduct::latest()->paginate(15),
            'categories' => Category::all()
        ])->layout('admin.layouts.wire_app');
    }
}
