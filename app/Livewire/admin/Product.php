<?php

namespace App\Livewire\Admin;

use App\Models\Product as ModelsProduct;
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
                'weight' => 'required|numeric',
                'image' => 'required|image',
                'category' => 'required',
                'thumbnail' => 'required|image',
            ]);

            ModelsProduct::create([
                'name'        => $this->name,
                'weight'        => $this->weight,
                'sku' =>        "no sku",
                'description' => $this->description,
                'thumbnail'  => $this->storeImage($this->thumbnail),
                'image'  => $this->storeImage($this->image),
                'category_id' => $this->category,
            ]);
            $this->name = "";
            $this->description = "";
            $this->image = "";
            $this->thumbnail = "";
            $this->category = "";
            $this->weight = "";
            session()->flash('message', 'Created successfully.');
        }
    }

    public function storeImage($img)
    {
        if (!$img) {
            return null;
        }
        $image   = $this->img;
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
        $this->edit_thumbnail = $product->thumbnail;
        $this->button_text = "Update Product";
    }
    public function update($id)
    {
        $this->validate([
            'name' => 'required|max:50',
            'description' => 'required|max:255',
        ]);

        $product = ModelsProduct::findOrFail($id);
        $product->name = $this->name;
        $product->description = $this->description;

        if ($this->image) {
            $this->validate([
                'image' => 'image|max:3072',
            ]);
            unlink($product->thumbnail);
            $product->thumbnail = $this->storeImage($this->image);
        }
        if ($this->image) {
            $this->validate([
                'image' => 'image|max:3072',
            ]);
            unlink($product->thumbnail);
            $product->thumbnail = $this->storeImage($this->image);
        }
        $product->save();
        $this->name = "";
        $this->description = "";
        $this->edit_image = "";
        $this->image = "";
        session()->flash('message', 'Updated Successfully.');
        $this->button_text = "Add New Product";
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);
        unlink($product->thumbnail);
        unlink($product->image);
        $product->delete();
        session()->flash('message', 'Deleted Successfully.');
    }

    public function render()
    {
        return view('livewire.admin.product', [
            'products' => ModelsProduct::latest()->paginate(15),
        ])->layout('admin.layouts.wire_app');
    }
}
