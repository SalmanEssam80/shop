<?php

namespace App\Livewire\Admin;

use App\Models\Category as ModelsCategory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;

class Category extends Component
{
    public $name;
    public $description;
    public $thumbnail;
    public $edit_thumbnail;
    public $edit_employee_id;
    public $edit_category_id;
    public $button_text = "Submit";

    public function add_new_category()
    {
        if($this->edit_category_id){
            $this->update($this->edit_employee_id);
        }else{
            $this->validate([
                'name' => 'required|min:4|max:50',
                'description' => 'required',
                'thumbnail' => 'required|image',
            ]);

            Category::create([
                'name' => $this->name,
                'description' => $this->description,
                'thumbnail' => $this->storeImage(),
            ]);


            $this->name="";
            $this->description="";
            $this->thumbnail="";


            session()->flash('message', 'Category Created successfully.');
        }
    }

    public function storeImage()
    {
        if (!$this->thumbnail) {
            return null;
        }
        $img = $this->thumbnail;
        $name  = Str::random() . '.jpg';
        Storage::disk('public')->put($name,$img);
        return config('app.url').'storage/'.$name;
    }

    public function edit_category($id)
    {
        $category = Category::findOrFail($id);
        $this->edit_employee_id = $id;
        $this->name = $category->name;
        $this->description = $category->description;
        $this->edit_thumbnail    = $category->thumbnail;

        $this->button_text="Update";
    }

    public function update($id)
    {
        $this->validate([
            'name' => 'required|min:4|max:50',
            'description' => 'required',
        ]);
        $category = Category::findOrFail($id);
        $category->name = $this->name;
        $category->description = $this->description;
        if ($this->thumbnail) {
            $this->validate([
                'thumbnail' => 'image',
            ]);
            Storage::disk('public')->delete($category->thumbnail);
            $category->thumbnail = $this->storeImage();
        }
        $category->save();

        $this->name="";
        $this->description="";
        $this->thumbnail="";
        $this->edit_category_id="";
        session()->flash('message', 'Cateogyr Updated Successfully.');

        $this->button_text = "Update";

    }

    public function delete_category($id)
    {
        Category::findOrFail($id)->delete();
        session()->flash('message', 'Category Deleted Successfully.');

        $this->name="";
        $this->description="";
        $this->thumbnail="";
    }

    public function render()
    {
        return view('livewire.admin.category',['categories' => ModelsCategory::latest()->paginate(10)]);
    }
}
